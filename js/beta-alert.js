$("body").prepend("<style> #beta-alert p {margin: 0; font-weight: 600; font-size: 18px; color: #fff; } #beta-alert {display: none; width: 100%; background-color: rgb(58, 57, 57); overflow: hidden; padding: 10px 5px; } #group {margin-top: 35px; } #beta-text, #beta-button {float: left; text-align: center; overflow: hidden; width: 100%; display: inline; } #beta-button {width: 100%; padding-top: 15px; } #beta-button a {display: block; font-size: 16px; color: #fff; background-color: #500000; text-decoration: none; padding: 15px 0; width: 90%; margin: 0 auto; border-radius: 5px } #beta-button a:hover {background-color: #550001; } #close-alert a{color: #fff; text-decoration: none; position: absolute; top: 10px; left: 15px; font-size: 18px } @media screen and (min-width: 630px) {#group {width: 90%; margin: 0 auto; margin-top: 35px; } #beta-text {width: 72.91667%; margin: 0 1.04167% } #beta-button {width: 24%; padding-top: 0; } } @media screen and (min-width: 840px) {#group {max-width: 1004px; margin: 0 auto; } #beta-text {padding-top: 8px; text-align: left; } #beta-button a {padding: 10px; } } </style> <div id='beta-alert'> <div id='group'> <div id='beta-text'> <p>Help us improve your experience by taking this short survey</p> </div> <div id='beta-button'> <a href='http://agrilife.org/communications/college-of-agriculture-and-life-science-beta-survey/'>Take the survey</a> </div> </div> <span id='close-alert'><a href='#'>x</a></span> </div>");
$("#beta-alert").slideDown();
$("#close-alert").click( function() {
  $("#beta-alert").slideToggle();
});