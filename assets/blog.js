$('table tr td').on('change', 'input[type=checkbox]', function()
{
  var method = $(this).data('method') ? $(this).data('method') : 'GET';
  var target = $(this).data('target');

  if(target == '')
  {
    console.log("Please set a data-target attribute.");
    return;
  }

  if('onchange' === $(this).data('action'))
  {
    $.ajax({
        type: method,
        url: target,
        datatype: 'json',
        cache: false,
        async: true,
        success: function(myObj)
        {
          if(myObj.flug)
          {
            location.reload();

          }else{}
        },
        error: function(data)
        {
          console.log(data);
        }
    });
  }
})