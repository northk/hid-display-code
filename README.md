hid-display-code
================

**hid-display-code** is a WordPress plugin which displays code in your WordPress posts. Code can be displayed either inline within a paragraph, or as an embedded reference to a Github Gist (which will display your Gist). For code within a paragraph, you can specify CSS class(es) to style the code with.

The plugin is designed so that you can use the WordPress visual editor rather than the text editor. It removes the default 'texturize' behavior for the content within the shortdcode so that double quotes do not become smart quotes and single quotes do not become apostrophies. That's what you want if you are showing a snippet of sample code.

To use it, first copy the 'hid-display-code' folder into wp-content/plugins. Then activate the plug-in in the WordPress control panel.

Then insert a shortcode into a page or post like this:

**For inline code (within a paragraph):**
`This is a paragraph, and [hid-display-code type="inline" classes="hid-inline-code"]This is some code within a paragraph[/hid-display-code]. Isn't that neat?`

**For an embedded Github Gist (on a line by itself):**
`[hid-display-code type="gist" id="7635946" file="test.css"][/hid-display-code]`

`class` is an optional parameter for `type ="inline"`. It specifies a list of CSS classes to be applied to the span that will display the code.

For `type="gist"`, you have to use the Github-defined class names in order to affect the display of the code.

To get you started on styling Github gists, here is the CSS I used. This will need to be modified to suit your site, of course!

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

Brought to you by North Krimsly at [www.highintegritydesign.com](http://www.highintegritydesign.com) Enjoy!
