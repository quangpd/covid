$(function () {
  $("#tags").autocomplete({
    source: function (request, response) {
      $.post(
        BASE_PATH + "admin/keywords/auto_complete",
        { term: extractLast(request.term) },
        response,
        "json"
      );
    },
    minLength: 2,
    search: function () {
      var term = extractLast(this.value);
      if (term.length < 2) {
        return false;
      }
    },
    focus: function () {
      return false;
    },
    select: function (event, ui) {
      var terms = split(this.value);
      terms.pop();
      terms.push(ui.item.value);
      terms.push("");
      this.value = terms.join(", ");

      return false;
    },
  });

  CKEDITOR.replaceClass = "ckeditor";

  $(".button-file").on("click", function () {
    var p = $(this).parent(".input-group");
    openElFinderFile(p);
  });

  $(".button-clear-file").on("click", function () {
    $(this).siblings("input").val("");
  });

  $(".button-open-file").on("click", function () {
    location.href = BASE_URL + $(this).val();
  });

  $(document).on("click", "#btn_delete", function (event) {
    event.preventDefault();
    if (confirm("Xóa những bản ghi này!?")) {
      $.post(
        BASE_PATH + "admin/articles/delete",
        $("#form").serialize(),
        function (data) {
          tablesortable.reload();
          $("input[name=action_to_all]").prop("checked", false);
        }
      );
    }
  });
});
