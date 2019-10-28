# Buto-Plugin-MailchimpApi_3
Add or remove email from a Mailchimp list.

## Settings
```
plugin:
  mailchimp:
    api_3:
      data: 'yml:/../buto_data/theme/[theme]/_data_file_.yml'
```
Data file.
```
list_id: _check_Audience_Settings_in_Mailchimp_
api_key: _Mailchimp_API_KEY_
```

### API key

Go to Account/Extras/API keys and click button "Create A Key".

### List ID

Go to Audience/Manage Audience/Settings and scroll down and find "Unique id for audience (name of list)".

## PHP
Object.
```
wfPlugin::includeonce('mailchimp/api_3');
$mailchimp = new PluginMailchimpApi_3();
```

Add email (nothing will be added if already exist).
```
$mailchimp->add('me@world.com');
```

Delete email.
```
$mailchimp->delete('me@world.com');
```

## API Reference

This plugin is built on API calls to mailchimp.com. Check out there reference to continue working on this plugin.

https://mailchimp.com/developer/reference/

Lists/Audiences, Members, Add a new list member.
