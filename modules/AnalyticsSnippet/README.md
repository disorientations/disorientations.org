Analytics Snippet (module for Omeka S)
======================================

[Analytics Snippet] is a module for [Omeka S] that allows the global admin to
add a snippet, generally a javascript tracker, at the end of the public pages
and/or at the end of admin pages. It can track json and xml requests too via
sub-modules.

It’s primarly designed for open source analytics platforms, like [Piwik] or [Open Web Analytics],
but it can be used with any other competitor services like [Woopra], [Google Analytics]
or [Heap Analytics], if you don’t fear to give the life of your visitors for
free (or by paying) to people who manipulate and sell them with a big profit.
Any other javascript or html code can be added too.

Sub-modules can be enabled too to track api json and xml calls, for example [Analytics Snippet Piwik].


Installation
------------

Uncompress files and rename module folder `AnalyticsSnippet`. Then install it
like any other Omeka module and follow the config instructions.

See general end user documentation for [Installing a module].


Usage
-----

The code can be set in the config of the module and/or in the site settings.

Note: For technical reasons, the html code must start with `<!DOCTYPE html>`,
without useless space or line break at the beginning.


Warning
-------

Use it at your own risk.

It’s always recommended to backup your files and your databases and to check
your archives regularly so you can roll back if needed.


Troubleshooting
---------------

See online issues on the [module issues] page on GitHub.


License
-------

This module is published under the [CeCILL v2.1] licence, compatible with
[GNU/GPL] and approved by [FSF] and [OSI].

This software is governed by the CeCILL license under French law and abiding by
the rules of distribution of free software. You can use, modify and/ or
redistribute the software under the terms of the CeCILL license as circulated by
CEA, CNRS and INRIA at the following URL "http://www.cecill.info".

As a counterpart to the access to the source code and rights to copy, modify and
redistribute granted by the license, users are provided only with a limited
warranty and the software’s author, the holder of the economic rights, and the
successive licensors have only limited liability.

In this respect, the user’s attention is drawn to the risks associated with
loading, using, modifying and/or developing or reproducing the software by the
user in light of its specific status of free software, that may mean that it is
complicated to manipulate, and that also therefore means that it is reserved for
developers and experienced professionals having in-depth computer knowledge.
Users are therefore encouraged to load and test the software’s suitability as
regards their requirements in conditions enabling the security of their systems
and/or data to be ensured and, more generally, to use and operate it in the same
conditions as regards security.

The fact that you are presently reading this means that you have had knowledge
of the CeCILL license and that you accept its terms.


Contact
-------

Current maintainers:

* Daniel Berthereau (see [Daniel-KM] on GitHub)


Copyright
---------

* Copyright Daniel Berthereau, 2017-2019


[Analytics Snippet]: https://github.com/Daniel-KM/Omeka-S-module-AnalyticsSnippet
[Omeka S]: https://omeka.org/s
[Piwik]: https://piwik.org
[Open Web Analytics]: http://www.openwebanalytics.com
[Woopra]: https://www.woopra.com
[Google Analytics]: https://www.google.com/analytics
[Heap Analytics]: http://heapanalytics.com
[Analytics Snippet Piwik]: https://github.com/Daniel-KM/Omeka-S-module-AnalyticsSnippetPiwik
[Installing a module]: http://dev.omeka.org/docs/s/user-manual/modules/#installing-modules
[module issues]: https://github.com/Daniel-KM/Omeka-S-module-AnalyticsSnippet/issues
[CeCILL v2.1]: https://www.cecill.info/licences/Licence_CeCILL_V2.1-en.html
[GNU/GPL]: https://www.gnu.org/licenses/gpl-3.0.html
[FSF]: https://www.fsf.org
[OSI]: http://opensource.org
[Daniel-KM]: https://github.com/Daniel-KM "Daniel Berthereau"
