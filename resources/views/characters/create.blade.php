@extends('layouts.layout')

@section('title', 'Character Sheet')

@section('button')
  <button name="buttonsave" type="button" onclick="save_character()" style="width:100px;margin-bottom:5px;margin-right:595px;">Save character</button>
  <button id="buttonclose" name="buttonclose" type="button" onClick="closeSheet();" style="width:100px;margin-bottom:5px;">Close</button>
  <label for="autocomplete" style="text-transform:Capitalize;font-weight:bold;padding:0px 10px;">Enable autocomplete character stats?</label><input name="autocomplete" id="autocomplete" type="checkbox" />
@endsection

@section('script')
<script>
$(document).ready(function(){
  restoreStorage();
});
function save_character() {
  console.log("Saving character...")

  // Prepare form data for JSON format
  const formId = "charsheet";
  var url = location.href;
  const formIdentifier = `${url} ${formId}`;
  let form = document.querySelector(`#${formId}`);
  let formElements = form.elements;

  let data = { [formIdentifier]: {} };
  for (const element of formElements) {
    if (element.name.length > 0) {
      if (element.type == 'checkbox') {
        var checked = ($("[name='" + element.name + "']").prop("checked") ? 'checked' : 'unchecked');
        data[formIdentifier][element.name] = checked;
      } else {
        data[formIdentifier][element.name] = element.value;
      }
    }
  }
  data = JSON.stringify(data[formIdentifier], null, 2)
  $.ajax({
    type: "POST",
    url: "/characters",
    data: { 
      "_token": "{{ csrf_token() }}",
      "sheet": data,
      "charname": document.getElementById('charname').value
    },
    success: function (data) {
      localStorage.removeItem('dnd_sheet_backup');
      alert(data["message"]);
      ask = false;
      location.href = "/characters/"+data["id"]+"/edit";
    }
  });
}
</script>
@endsection