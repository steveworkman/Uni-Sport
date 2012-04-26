Uni-Sport
=========

Sports website engine originally designed for Sheffield University Hockey Club

##History
I played for the Sheffield University Hockey Club whilst I was at the university from 2003-2007. As an outlet to practice all the stuff I was learning from my degree, I made a website for the hockey club.
Over the years it evolved into this: a bespoke CMS for sports clubs, which at its height was used by two rugby clubs, the rowing club, the squash club and the hockey club. It's written in PHP using the [Smarty](http://www.smarty.net/) templating language and a MySQL database. Front-end shennanigans are performed by jQuery 1.1.4!

##Features
* Facebook login integration
* Post news and events
* Team captains can create squads from players
* Write detailed match reports
* Add pictures to albums (including matches and events)
* Integrated PHPBB2 forums (with linked authentication)
* Fantasy league system integrated with the match reports system
* Calendars, birthdays, RSS, and a bunch more stuff that I've forgotten that I'd written

###Installation
1. Run the CreateDB.sql script into a MySQL database
2. Update the connection details in inc/connect.inc.php
3. Run the site!
4. If you want Facebook authentication, you'll need to update the api_key and secret in inc/facebook.inc.php
5. You may also need to do some hacking in the config table of the database to make URLs work properly

###Demo
There's a demo site available at http://sheffieldhockey.steveworkman.com

##Credits
The whole thing was created by [Steve Workman](http://www.steveworkman.com) - [Twitter](http://twitter.com/steveworkman)

##License
Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the 'Software'), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED 'AS IS', WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.