=== About

This is meant to be a very small scale web based Pathfinder character
sheet manager.  Install it onto your own web server and give your players
the player username and password, and keep the game master username and
password to yourself (if you want.)

This will *not* keep track of which sheets have been created by who.  It will
keep a recent history of sheets edited per computer using local storage.

When a sheet is created the person that created it will recieve an edit url for
the sheet. This edit url can be used by anyone logged in to edit the sheet.

If you want to share a sheet for viewing only then use the public url provided
by the character sheet.  This will give anyone access to reading the sheet.
You do not have to be logged in to view a sheet.

The game master login provides a list of all character sheets in the database.
The game master can edit, view, or delete any sheet that exists.  This is
essentially the admin account.

This will manage basic character data but will not automatically apply rules
or mechanics like PCGen or other character generator software.

For the best results use Google Chrome with Javascript enabled.

=== Setup

1.) Set up your config.php variables.

2.) Upload all the files to your web server.

3.) Go to the url where you uploaded it.

4.) Enter the info required and install.

5.) Make character sheets!

=== Updating

When updating to a new version you may need to add columns to your character
sheet table that don't already exist.  The easiest way to do this is to
enable dev mode via your config.php temporarily.  After enabling dev mode
save a character sheet and the missing columns should be added.

Another option is to export all character sheets and reinstall the application.

To verify that you have all necessary columns check your character tables columns
against the install script located in process.php.

Sorry this is a pain but hopefully it won't happen too often!

=== Change Log

= v1.0.10
    * Cosmetic fixes for wide screen view
    * Fixed bug where init misc and temp values were not saved
    * Fixed bug where adding new rows would blank out drop downs

= v1.0.00
    * First 1.0 release

= v0.9.*
    * Released beta version

=== Resources

Milligram: https://milligram.github.io/
jQuery: https://jquery.com/
Tags: http://xoxco.com/projects/code/tagsinput/
