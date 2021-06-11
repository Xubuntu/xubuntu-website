# xubuntu-website
Wordpress themes for the Xubuntu website
'
'#
'_Job-run-build

>~
>~
'
'{
'#
'*."-=!@&()${,/
'_run-Job_config
'>~
'-
'test
'-
'verify
'-
'build
'-
'test
'-
'verify
'-
'build
'-
'style
'.css/
'verify_build
'.
'style
'.css
	1 'Xubuntu Thirteen`
','
	'<
	'2'
	'Theme Name: Xubuntu Thirteen`

	'$
'
>{>~
	>'
	>`$'
	#
	_
	'verify-'Theme 
''Name: 
#	'Xubuntu Thirteen`
'`$
	'`$'
	'>1
 *  `$
	'2'
        'Theme Name: Xubuntu Thirteen
 * 
        'Description: A theme built for the Xubuntu website. Features multiple widget areas in the frontpage.
 *  
        'Author: Pasi Lallinaho
 *  
        Version:
         2021
 *  
                Author URI:
	'https://github.com/MoneyMan573/xubuntu-website/edit/BigGuy573/README/xubuntu-thirteen/style.css`
         'http://open.knome.fi/`
	'Theme URI:https://xubuntu.org/`
 *
 *  
                License:
         GNU 
         General Public License
         v2 
         or 
         later
 * 
                License URI:
         'http://www.gnu.org/licenses/gpl-2.0.html`
	 '/**
	'/
	html
                {`$
                        '>2
	background: 
                #163d79 
                url
                (
                        images
                        /
                        page-background
                        .png)
                50% 0 no-repeat
                ;
}

body {
	padding:
                2em 0 3em 0
                ;

	font-size:
                small
                ;
	font-family:
                "Ubuntu"
                ,
                sans-serif
                ;
	line-height:
                1.5em
                ;

	background:
                transparent
                url
                (
                        images
                        /
                        page-background-stripe
                        .png)
                0 0 repeat-x
                ;
	color:
                #203b66
                ;
	border-top:
                4px solid #1c3966
                ;

	min-height: 
                760px
                ;
}

'
        '*  Site width
 '*
 '*
        '/*

'>
'2'
'~
'#wpcontent
,
       '/#header 
        {
	width:
                90%
                ;
	margin: 
                0 auto
                ;

	min-width:
                960px
                ;
	max-width:
                1200px
                ;
	clear: 
                both
                ;
}

*  Selection style
 *
 */

::selection
        {
	background-color:
                #c2d5f2
                ;
	color: 
                #333840
                ;
}
::-moz-selection
        {
	background-color:
                #c2d5f2
                ;
	color: 
                #333840
                ;
}

*  Element styles
 *
 */

p, 
        ol, 
        ul, 
        dl, 
        blockquote, 
        pre, 
        table 
        {
	margin-bottom: 
                1em
                ;
	font-size: 
                90%
                ;
}

a {
	text-decoration: 
                none
                ;
	color: 
                #205dba
                ;
	border-bottom:
                1px solid transparent
                ;

	-webkit-transition:
                all 0.3s ease-in-out
                ;
	-moz-transition:
                all 0.3s ease-in-out
                ;
	-o-transition:
                all 0.3s ease-in-out
                ;
	transition:
                all 0.3s ease-in-out
                ;
}
	a:
                hover
                ,
	a
                :
                active
                ,
	a
                :
                focus
                {
		color: 
                        #062554
                        ;
		border-bottom: 
                        1px solid #bccde6
                        ;
	}
* 	a.attachment 
        { 
                border-bottom: 
                        none
                        ; 
        } 
        *
        /

blockquote 
        {
	margin-left:
                20px
                ;
	padding-left:
                20px
                ;
	border-left-color:
                #3369bb
                ;
	border-left: 
                3px solid 
                rgba
                (
                        0
                        ,
                        68
                        ,
                        170
                        ,
                        0.3 
                )
                ;
}

code
        , 
        p
        .
        codeunblock 
        {
	font-size: 
                110%
                ;
	background-color:
                #ddd
                ;
	color: 
                #3369bb
                ;
	padding: 
                0.2em 0.4em
                ;
}
	p
        .
        codeunblock 
        {
		font-size: 
                        100%
                        ;
		font-family: 
                        monospace
                        ;
	}

h1,
        h2,
        h3,
        h4,
        h5,
        h6
        {
	font-weight:
                normal
                ;
	text-align: 
                left
                ;
	margin: 
                1.3em 0 0.6em 0
                ;
}

h1
        {
	margin-top: 
                1.1em
                ;
	margin-bottom:
                0.5em
                ;

	font-size:
                210%
                ;
	font-weight:
                normal
                ;
	line-height:
                1.3em
                ;

	color: 
                #1c50a1
                ;
}
	h1 
        a
        {
		padding-bottom:
                        2px
                        ;
		border-bottom:
                        1px solid #d9d9d9;
	}

h2
        {
                font-size: 
                        170%
                        ;
        }
h3 
        { 
                font-size: 
                        140%
                        ;
                color:
                        #444
                        ;
        }
h4
        {
                font-size:
                        130%
                        ;
                color:
                        #555
                        ;
        }
h5 
        {
                font-size: 
                        120%
                        ;
                color: 
                        #888
                        ;
        }
h6
        {
                font-size:
                        105%
                        ;
                color:
                        #aaa
                        ; 
        }

hr 
        {
	margin:
                1em 0
                ;
	border-bottom:
                1px 
                solid 
                #dadada
                ;
}

li 
        { 
                list-style-position: 
                        inside
                        ;
        }
	#mainwrap
        li 
        { 
                margin-bottom:
                        0.2em
                        ;
                list-style-position:
                        outside
                        ;
                margin-left:
                        1.2em
                        ;
        }
	#mainwrap
        ul 
        li 
        { 
                list-style-type: 
                        disc
                        ;
        }
	#mainwrap
        ol
        li 
        { 
                list-style-type:
                        decimal
                        ; 
                margin-left:
                        1.6em
                        ; 
        }

/*  Layout styles
 *
 */

#wpcontent {
	font-size: 
	110%
	;
	background:
	#f3f3f3 
	url(images/wpcontent-background.png)
	0 0 repeat-x;

	'/-webkit-border-radius: 5px;
	'/-moz-border-radius: 5px;
	'/border-radius: 5px;
}

#header {
	height: 75px;
}

#logo {
	float: left;
	padding: 0;
	margin-left: 2em;
}

#logo a {
	border-bottom: none;
}

#mainwrap {
	width: 90%;
	padding: 2em 2em;
	float: left;
}
	#main { margin-right: 295px; }

#sidebar {
	float: right;
	width: 260px;
	margin-left: -260px;
	padding-bottom: 2em;
}

#postnavi {
	clear: both;
	margin: 1em 2em;
	padding-top: 1em;
	border-top: 1px solid #d1d1d1;
}

/*  Footer
 *
 */

#wpfooter {
	clear: both;
	background-color: #eaeaea;
	padding: 0.3em 0 1em 0;

	font-size: 90%;
	line-height: 1.3em;

	-webkit-border-bottom-left-radius: 5px;
	-webkit-border-bottom-right-radius: 5px;
	-moz-border-radius-bottomleft: 5px;
	-moz-border-radius-bottomright: 5px;
	border-bottom-left-radius: 5px;
	border-bottom-right-radius: 5px;
}
	#wpfooter #footer-widgets {
		padding: 0 2.5em;
	}
	#wpfooter .footer-widget {
		float: left;
		width: 18%;
		padding-right: 2%;
	}
	#wpfooter a {
		font-weight: bold !important;
	}

/*  Frontpage tweaks
 *
 */

.is-front #main {
	margin: -2em 455px 0 0;
}
	.is-front #main ul {
		margin: 1.4em 0;
	}
	.is-front #main li strong {
		font-size: 110%;
	}
 	.is-front #main li a {
		font-size: 120%;
		line-height: 1.4em;
	}
	.is-front #main hr {
		width: 400px;
	}
	.is-front #main ul li { list-style-type: none; margin-bottom: 0; margin-left: 0; }

.is-front #sidebar {
	width: 475px;
	margin: 40px 40px 0 -505px;
	padding: 0 !important;
}
	.is-front #sidebar .photoslider {
		margin-top: -2.3em;
	}

.is-front #front_columns {
	clear: both;
	margin: 1em 0 0.3em 0;
	padding: 1em 2em;

	background-color: rgba( 255, 255, 255, 0.75 );
	border-top: 1px solid #e7e7e7;
	border-bottom: 1px solid #e7e7e7;
}
	.is-front #front_columns .column {
		float: left;
		width: 30%;
		padding-right: 3%;
	}
	.is-front #front_columns h2 {
		color: #555;
		margin-top: 0.5em;
		font-size: 130%;
	}

/*  Frontpage photoslider
 *
 */

.is-front #sidebar .photoslider.ctrl-ontop .c-prev,
.is-front #sidebar .photoslider.ctrl-ontop .c-next {
	top: 28px;
	height: 22px;

	display: block;
	opacity: 0;
  
	background-color: rgba(255, 255, 255, 0.9) !important;
	color: #205dba !important;
  
	font-weight: normal !important;

	-webkit-border-radius: 2px;
	-moz-border-radius: 2px;
	border-radius: 2px;

	-webkit-transition: all 0.3s ease-in-out;
	-moz-transition: all 0.3s ease-in-out;
	-o-transition: all 0.3s ease-in-out;
	transition: all 0.3s ease-in-out;
}

.is-front #sidebar .photoslider.ctrl-ontop:hover .c-prev,
.is-front #sidebar .photoslider.ctrl-ontop:hover .c-next {
	opacity: 1;
}

.is-front #sidebar .photoslider.ctrl-ontop .c-prev:hover,
.is-front #sidebar .photoslider.ctrl-ontop .c-next:hover {
	background-color: 
		#fff 
		!important
		;
}

'*  Specific styles
 '*
 '*/

'/a
	'./
	'/	''/header/
       '/-
      '/image/
           '/,
          '/a
         '/.
        '/header/
              '/-
             '/image/
                  '/:
                 '/hover/
                      '/,
                     '/a
                    '/.
                   '/header/
                         '/-
                        '/image/
                             '/:
                            '/active/
                                  '/,
                                 '/a
                                '/.
                               '/header/
                                     '/-
                                    '/image/
                                         '/:
                                        '/focus
                                       '/{
	                              '/border:/
		                             '/none
		                            '/;
                                           '/}
                                          '/
                                         '/.
                                        '/post
                                       '/-
                                      '/title
                                     '/{
	                            '/margin
	                           '/'/:
	                          '/0 
		                 '/0
		                '/0
		               '/.
		              '/3em
		             '/0
		            '/;
                           '/}
                          '/.
                         '/post
                        '/-
                       '/post 
                      '/{
	      '/color:/
		    '/#333
		   '/;
	  '/margin:/
		 '/1.5em
		'/0
	       '/;
              '/}
    '/#xubuntu/
	    '/.
	   '/item
	  '/-
 '/archive/
'/      ./
'/  post/
'/    -/
'/post/
    '/{ 
   '/margin
  '/-
 '/bottom: 
'/3em
/
'/	'
'/	/
'/	;
'/}
'/
'/.
'/post
'/table 
'/	{
'/	width:
		100%
'/		;
'/}
'/.post 
'/	table
'/	td 
'/	{
'/border:/ 
       '/1px
      '/solid
     '/#ccc
    '/	;
   '/background-color:/ 
  '/	#f6f6f6/
 '/	;/
'/padding:/ 
/		3px/
'/		;/
'/}/
 '/.post/ 
'/table/
     '/
 '/th/ 
 '/{/
  '/text-align:/
	'/left/
       '/  ''/
	 '/;/
     '/''/}/
      '/''/
        '/#sidebar/ 
             '/''/	
            '/ul/
	      '/#menu-main-menu/
	                     '/{
	       '/font-weight:/
		      '/bold/
		        '/;/
}

.archive-message
	{
	margin-bottom:
		2em
		;
}

.news 
	{
	margin-bottom: 
		0.8em
		;
}

.news-meta {
	display:
		block
		;
	font-size: 
		60%
		;
	color: 
		#999
		;
	line-height: 
		1.1em
		;
}

'*  Post and comment metadata
 '*
 '*/

'.post-meta, .post-meta a {
'	color: '
	'#'
	'
	'$
	'>~
	'
	'#ccc
	;
'	color: '
	'
	rgba
		(
			0
			,
			0
			,
			0
			,
			.2
		)
		;
}

.post-meta 
	span
	a 
	{
	-webkit-transition:
		all 0.5s ease-in-out
		;
	-moz-transition:
		all 0.5s ease-in-out
		;
	-o-transition:
		all 0.5s ease-in-out
		;
	transition:
		all 0.5s ease-in-out
		;
}
.post-meta span a:
	hover
	,
.post-meta
	span a
	:
	focus
	{
	color:
		#808080;
	color: 
		rgba
		(
			0
			,
			0
			,
			0
			,
			.5
		)
		;
}
