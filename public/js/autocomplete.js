var myArr = [];

  $.ajax({
    type: "GET",
    url: "../dataMap/data.xml",
    dataType: "xml",
    success: parseXml,
    complete: setupAC,
    failure: function (data) {
      alert("XML File could not be found");
    }
  });

  function parseXml(xml) {
    $(xml).find("marker").each(function () {
      title = $(this).attr("name");
      id = $(this).attr("type");

      urlpageautocomplete = $(this).find('urlpage').attr("url");

      $("#debug").append($("<div/>").text(title));
      myArr.push(new SearchItem(title, id, urlpageautocomplete));
    })
  }

  var SearchItem = function (title, id, category, urlimage, urlpageautocomplete) {
    var ret = new Object();
    ret.value=title;/*NEED THIS TO SEARCH*/
    ret.lable=title;/*NEED THIS TO DISPLAY IN SEARCH BOX*/
    ret.title = title;
    ret.id = id;

    return ret;
  }

    function setupAC() {
        $("input#searchMarker").autocomplete({
            minLength: 3,
            source: myArr,
            focus: function (event, ui) {
                $('input#searchMarker').focus();
                return false;
            },
            select: function (event, ui) {
                $("input#searchMarker").val(ui.item.value);
                return false;
            }
        });

    var ac = $("input#searchMarker").data("autocomplete")||$("input#searchMarker").data("ui-autocomplete");
    if(ac._renderItem){
      ac._renderItem = function (ul, item) {
        return $("<li>")
          .append(item.renderHtml).appendTo(ul);
      };
    }
    }