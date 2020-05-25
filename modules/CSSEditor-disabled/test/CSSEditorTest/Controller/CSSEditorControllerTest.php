<?php

namespace CSSEditorTest\Controller;

use OmekaTestHelper\Controller\OmekaControllerTestCase;

class CSSEditorAdminControllerTest extends OmekaControllerTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->loginAsAdmin();
    }

    public function testTextAreaShouldBeDisplayOnConfigure()
    {
        $this->dispatch('/admin/module/configure?id=CSSEditor');
        $this->assertXPathQuery('//textarea[@name="css"]');
    }

    /** @test */
    public function postCssShouldBeSaved()
    {
        $settings = $this->getServiceLocator()->get('Omeka\Settings');

        $this->postDispatch('/admin/module/configure?id=CSSEditor', [
            'css' => "h1{display:none;}"
        ]);

        $css_editor_css = $settings->get('css_editor_css');
        $this->assertEquals("h1 {\ndisplay:none\n}", $css_editor_css);
    }
}


class CSSEditorSiteControllerTest extends OmekaControllerTestCase
{
    protected $site_test;
    protected $site_test2;

    public function setUp()
    {
        parent::setUp();

        $this->loginAsAdmin();
        $this->site_test = $this->addSite('Test', 'test');
        $this->site_test2 = $this->addSite('Test 2', 'test2');

        $this->resetApplication();
    }

    public function tearDown()
    {
        $this->api()->delete('sites', $this->site_test->id());
        $this->api()->delete('sites', $this->site_test2->id());
    }

    /** @test */
    public function displayPublicPageShouldLoadCss()
    {
        $this->setSettings('css_editor_css', 'h1 {display:none}');
        $this->dispatch('/s/test');
        $this->assertXPathQuery('//style[@type="text/css"][@media="screen"]');
        $this->assertContains('h1 {display:none}',$this->getResponse()->getContent());
    }

    /** @test */
    public function displayPublicSitePageShouldLoadSpecificCss()
    {
        $this->setSettings('css_editor_css', 'h1 {display:none}');
        $this->getSiteSettings()->set('css_editor_css', 'h2 { color:black;}');
        $this->dispatch('/s/test');
        $this->assertXPathQuery('//style[@type="text/css"][@media="screen"]');
        $this->assertContains('h2 { color:black;}', $this->getResponse()->getContent());
        $this->assertNotContains('h1 {', $this->getResponse()->getContent());
    }

    /** @test */
    public function postCssShouldBeSavedForASite()
    {
        $this->postDispatch('/admin/module/configure?id=CSSEditor', [
            'css' => "h1{display:inline;}",
            'site' => $this->site_test->id()
        ]);
        $this->assertEquals("h1 {\ndisplay:inline\n}", $this->getSiteSettings()->get('css_editor_css'));
    }

    /** @test */
    public function postBrowseBeSavedForASiteAndReturnDefaultValue()
    {
        $this->setSettings('css_editor_css','div {display:none}');
        $this->postDispatch('/admin/csseditor/browse', [
            'css' => "h1{display:inline;}",
            'site' => $this->site_test->id(),
        ]);
        $this->assertResponseStatusCode(200);
        $this->assertContains('div {',$this->getResponse()->getContent());
        $this->assertEquals("h1 {\ndisplay:inline\n}", $this->getSiteSettings()->get('css_editor_css'));
    }

    /** @test */
    public function postBrowseBeSavedForASiteAndReturnValue()
    {
        $this->postDispatch('/admin/csseditor/browse/' . $this->site_test2->id(), [
            'css' => "h1{display:inline;}",
            'site' => $this->site_test->id()
        ]);

        $this->assertEquals('', $this->getResponse()->getContent() );
        $this->assertEquals("h1 {\ndisplay:inline\n}", $this->getSiteSettings()->get('css_editor_css'));
    }

    /** @test */
    public function postBrowseBeSavedForDefaultSite()
    {
        $this->postDispatch('/admin/csseditor/browse/' . $this->site_test2->id(), [
            'css' => "h1{display:inline;}",
            'site' => '',
        ]);
        $this->assertEquals('', $this->getResponse()->getContent());
        $this->assertEquals("h1 {\ndisplay:inline\n}", $this->getServiceLocator()->get('Omeka\Settings')->get('css_editor_css'));
    }

    protected function getSiteSettings()
    {
        $serviceLocator = $this->getServiceLocator();
        $settings = $serviceLocator->get('Omeka\Settings\Site');

        $settings->setTargetId($this->site_test->id());
        return $settings;
    }

    protected function addSite($title, $slug)
    {
        $response = $this->api()->create('sites', [
            'o:title' => $title,
            'o:slug' => $slug,
            'o:theme' => 'default',
        ]);

        return $response->getContent();
    }
}
