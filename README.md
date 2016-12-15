# slack_connect

This is a plugin for use with the open source DAM, Resource Space. This plugin will send a message to a slack channel when a user uploads a file that needs review.

Just activate and change configure settings in the plugin manager - no coding required.

1. Slack Webhook URL - can be located here for your Slack account.
https://api.slack.com/incoming-webhooks

2. Username - The Name of the Slack Bot

3. Room - this should be lower case (copy directly from Slack)

4. Color Options - Normal (no color) Good (green) Warning (orange) Danger (red)

5. Message - What Should be Posted in Slack

6. URL - This is the link attached to the Message - Suggested to be linked to your resource approval page

7. Message sent to older devices - Seen by devices that cannot handle HTML


This plugin relies on curl to work, if you do not have it on your server - it can be installed on ubuntu using cli

sudo apt-get install php-curl