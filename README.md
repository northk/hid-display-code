hid-display-code
================

**hid-display-code** is a WordPress plugin which displays formatted code in your WordPress posts. Code can be displayed either inline within a paragraph, or as a public Github Gist. 

The plugin is designed so that you can use the WordPress visual editor rather than the text editor. It removes the default 'texturize' behavior for content within the shortcode so that double quotes do not become smart quotes and single quotes do not become apostrophies. However the content is still HTML encoded. That's probably what you want if you are showing a snippet of sample code.

To use it, first copy the 'hid-display-code' folder into wp-content/plugins. Then activate the plug-in in the WordPress control panel.

Then insert a shortcode into a page or post like this:

## For inline code (within a paragraph): ##
A paragraph with code in it: `[hid-display-code]<div class="test"></div>[/hid-display-code]`. Neat, eh?

Inline code will be wrapped with a `<code>` element. So, you can style it by hooking into the `<code>` element like this:

`code {
    color: #9D2C0B;
    font-family: monospace, serif;
}`

## To display an embedded Github Gist (on a line by itself): ##
`[hid-display-code user="northk" gist="7635946" file="test.css"][/hid-display-code]`

* `user` is the Github user name and is required.  
* `gist` is the Gist ID and is required  
* `file` is a filename within the Gist, and is optional.

The above shortcode would generate code to display a gist, like this:

`<script src="http://gist.github.com/northk/7635946.js?file=test.css"></script>`

## Styling Gists ##

To style Gists, you have to use the Github-defined class names. To get you started on styling Github gists, here is some CSS I used. This will need to be modified to suit your site, of course!

```
.gist {
    font-size: 0.8em;
    font-family: Baskerville, "Baskerville Old Face", "Hoefler Text", Garamond, "Times New Roman", serif !important;
}

.gist-data {
    background-color: #FBFBFB !important; /* light grey */  

}

.gist .line
{
    font-family: "Consolas", "Courier New", Courier, "Bitstream Vera Sans Mono", monospace !important;
}       
```

## Potential Issues ##
Shortcodes must be fully closed, like this. Otherwise they won't be processed correctly:
`[hid-display-code][/hid-display-code] <== must be closed`

Brought to you by North Krimsly at [www.highintegritydesign.com](http://www.highintegritydesign.com) Enjoy!
