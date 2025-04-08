Description of TextMagic SDK import into Moodle.

Introduction
------------
Due to the fact Moodle already has several packages available in it's /lib folder,
the vendor folder in this plugin only imports what is strictly needed.

This also prevents us from using composer to install this package or any dependency.

This also prevents us from using composer to install this package or any dependency.
This may always change in the future.

Dependencies
------------
- guzzlehttp/guzzle: this requirement should be present in Moodle's /lib dir

Please check the above dependencies for validity and correctness according to
requirements for TextMagic as stated in TextMagic's composer.json.
Only when the requirements are met can we update this library.

Instructions
------------
1.  Check dependencies to confirm suitability of the new version of the library (see above).
2.  Visit [https://github.com/textmagic/textmagic-rest-php-v2].
3.  Click on 'X releases'.
4.  Download the latest release.
4a. OR download the main branch.
5.  Copy the main src folder into ./vendor/TextMagic.
6.  Update entry for this library in lib/thirdpartylibs.xml.
