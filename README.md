[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/Gifs/functions?utm_source=RapidAPIGitHub_GifsFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)

# Gifs Package
The gifs.com API makes it dead simple to convert and transcode a vast array of media into our HTML5 optimized gifs.com player, a compressed .gif, .webm and .mp4.
* Domain: [gifs.com](https://gifs.com/)
* Credentials: apiKey

## How to get credentials: 
1. Go to your gifs.com [API dashboard](https://gifs.com/dashboard/api)
2. Click generate key.

## Custom datatypes: 
  |Datatype|Description|Example
  |--------|-----------|----------
  |Datepicker|String which includes date and time|```2016-05-28 00:00:00```
  |Map|String which includes latitude and longitude coma separated|```50.37, 26.56```
  |List|Simple array|```["123", "sample"]``` 
  |Select|String with predefined values|```sample```
  |Array|Array of objects|```[{"Second name":"123","Age":"12","Photo":"sdf","Draft":"sdfsdf"},{"name":"adi","Second name":"bla","Age":"4","Photo":"asfserwe","Draft":"sdfsdf"}] ```  
 
## Gifs.importMedia
Gifs support importing the following file mime types: image/gif, video/mp4, video/webm and you can also link directly to a giphy, imgur, gfycat, streamable, instagram, twitter, facebook, or vine web page and we'll automagically find the best quality file to import.

| Field          | Type       | Description
|----------------|------------|----------
| apiKey         | credentials| Your API key
| source         | String     | The source URL of the media to add
| title          | String     | The title of the media
| tags           | List       | The tags relating the the media
| nsfw           | Select     | If the media is not safe for work
| attributionSite| String     | twitter, reddit, instagram, vine, or a custom URL
| attributionUser| String     | Required if isset attributionSite. The username for social media sites
| attributionUrl | String     | The url if site != social media

## Gifs.uploadMedia
You can upload image/gif, video/mp4, and video/webm media.

| Field           | Type       | Description
|-----------------|------------|----------
| apiKey          | credentials| Your API key
| file            | File       | The file being uploaded.
| title           | String     | The title of the media
| tags            | List       | The tags relating the the media
| nsfw            | Select     | If the media is not safe for work
| attribution_site| String     | twitter, reddit, instagram, vine, or a custom URL
| attribution_user| String     | The username for social media sites
| attribution_url | String     | The url if site != social media

