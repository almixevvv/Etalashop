<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.js"></script>
  <script type="text/javascript">
    $(function() {
      $('[data-r]').each(function() {
        var outer = $(this).wrap($('<span/>').css({
            position: 'relative'
          }))
          .click(function() {
            $(this).children('.toggle').toggleClass('visible').each(function() {
              if ($(this).hasClass('visible'))
                $(this).animate({
                  opacity: 1
                })
              else
                $(this).animate({
                  opacity: 0
                })
            })
          }).wrapInner($('<span class="space"/>').css({
            opacity: 0
          }))
        var word = $('<span class="toggle visible"/>')
          .appendTo(outer)
          .text($(this).text())
          .css({
            opacity: 1,
            position: 'absolute',
            left: 0
          })
        var r = $('<span class="toggle"/>')
          .appendTo(outer)
          .text($(this).data('r'))
          .css({
            opacity: 0,
            position: 'absolute',
            left: 0
          })
        if (word.width() < r.width())
          outer.find('.space').text(r.text()) // allocate space for the larger word.
      })
    })
  </script>
  <style type="text/css">
    a {
      font-size: 60px;
    }
  </style>
  <title>crossFade</title>
</head>

<body>
  <ol>
    <li>
      Who makes the pages? <a data-r="nerd">word</a>
    </li>
    <li>
      What does it take to make a cool page? <a data-r="brain">word</a>
    </li>
    <li>
      What is a really big word? <a data-r="cornucopia">word</a>
    </li>
  </ol>
</body>

</html>