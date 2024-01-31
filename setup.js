function loadingStart() {
  $("#divLoading").css("display","flex");
}

function loadingEnd() {
  $("#divLoading").css("display","none");
}

function listener_enter(btn_id, func) {
  document.getElementById(btn_id).addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
      event.preventDefault();
      eval(func);
    }
  });
}

function focus(id) {
  $("#"+id).focus();
}