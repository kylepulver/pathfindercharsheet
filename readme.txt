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

The game master login provides a list of all character sheets in a campaign.
They will have view and edit access to sheets in a campaign they have access
to.  Campaigns can be created and deleted by the super admin account.  The
admin can also set a passkey on campaigns so only a game master with the
passkey can access the sheets that belong to that campaign.

This will manage basic character data but will not automatically apply rules
or mechanics like PCGen or other character generator software.

For the best results use Google Chrome with Javascript enabled.

=== Setup

1.) Set up your config.php variables.

2.) Upload all the files to your web server.
2b.) Some hosts require you to make the database ahead of time!

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

= v1.2.50
    * Enable dev mode and save a character sheet to update to this version.
    * Disable dev mode when completed.  (This adds the proper columns.)

    * You can now select different abilities to use for saving throws.
    * Weight and weight status now displays on compact view.
    * Magic Items with links and descriptions now display on compact view.
    * Magic Items now have a weight field in their drop down.
    * There are now "apply damage" fields for making taking damage easier.
    * Applying lethal damage will subtract from temporary health first.
    * Tried to make regular gear vs magic gear more apparent in gear section.
    * Added notes to Saves and Resistance sections.
    * Various minor, and cosmetic fixes.

= v1.2.00
    * Warning: This version might not upgrade cleanly!
    * Use caution when upgrading and remember to back up your stuff first!
    * If you are upgrading the default admin account will be:
        username: admin
        password: the email address in your config file!
    * I added some stuff to hopefully make the update smooth, but who knows.

    * Added multicampaign support
    * Campaigns can have passkeys for minimal protection
    * Added super admin account for campaign management
    * The super admin account also acts as a GM account
    * Improved installation script for database creation
    * Added adjustable ability type for initiative
    * Same for melee to hit (like for using dex to hit)
    * Same for ranged to hit
    * Added a dex override for armor (like using cha or wis for armor)
    * Added point buy calculator for ability Scores
    * Fixed bug where AC didn't take into account a negative dex score
    * Fixed bug where armor max dex didn't display properly in certain cases
    * Added character languages to the GM view
    * Added campaign switching on characters in the GM view
    * Fixed a bug that wasnt showing ability scores correctly in GM view
    * Updated the status messages in the health bar section
    * Fixed favicon not showing sometimes
    * Moved Download All to the admin page
    * Fixed bug where Download All would break when there are no characters
    * Ability to hide and show sections of the sheet with clicks
    * Buttons to hide and show all sections
    * Added all skills to quick look side bar (when screen is wide enough)
    * Skills are now more compact in the main view
    * Fixed bug that allowed deleting sheets in compact view without retiring
    * Minor cosmetic updates

= v1.0.11
    * Fixed bug with floating points in container "Holding" field
    * Attack and Melee Misc and Temp fields now save properly

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
