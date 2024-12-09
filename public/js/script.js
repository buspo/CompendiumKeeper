$('.stat').bind('input', function()
    {
      var inputName = $(this).attr('name')
      var mod = parseInt($(this).val()) - 10
      
      if (mod % 2 == 0)
        mod = mod / 2
      else
        mod = (mod - 1) / 2
  
      if (isNaN(mod))
        mod = ""
      else if (mod >= 0)
        mod = "+" + mod
  
      var scoreName = inputName.slice(0, inputName.indexOf("score"))
      var modName = scoreName + "mod"
      
      $("[name='" + modName + "']").val(mod)
    })

$('.statmod').bind('change', function()
{
  var name = $(this).attr('name')
  name = "uses" + name.slice(0, name.indexOf('mod'))
  
})

$("[name='classlevel']").bind('input', function()
  {
    var classes = $(this).val()
    var r = new RegExp(/\d+/g)
    var total = 0
    var result
    while ((result = r.exec(classes)) != null)
    {
      var lvl = parseInt(result)
      if (!isNaN(lvl))
        total += lvl
    }
    var prof = 2
    if (total > 0)
    {
      total -= 1
      prof += Math.trunc(total/4)
      prof = "+" + prof
    }
    else
    {
      prof = ""    
    }
    $("[name='proficiencybonus']").val(prof)
  })

function totalhd_clicked()
{
  $("[name='remaininghd']").val($("[name='totalhd']").val())
}

// Row counts used for saving/loading characters
var rows_attacks = 2;
var rows_inventory = 2;
var rows_attunements = 3;
var rows_spells = 2;

function save_character()
{
  console.log("Saving character...")

  var filename = ".dnd";
  if (document.getElementById('charname').value == "") {
    filename = "CharacterSheet" + filename;
  } else {
    filename = document.getElementById('charname').value + filename;
  }

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
  type = 'application/json'

  // Save JSON to file
  var file = new Blob([data], {type: type});
  if (window.navigator.msSaveOrOpenBlob) // IE10+
      window.navigator.msSaveOrOpenBlob(file, filename);
  else { // Others
      var a = document.createElement("a"),
              url = URL.createObjectURL(file);
      a.href = url;
      a.download = filename;
      document.body.appendChild(a);
      a.click();
      setTimeout(function() {
          document.body.removeChild(a);
          window.URL.revokeObjectURL(url);  
      }, 0); 
  }
}

// Protective autosave feature
window.onbeforeunload = function(){
  if ($("[name='autosave']").prop("checked") == true) {
    save_character();
  }
}

// Functions for reading character from disk
function load_character(e) {

  // Autosave character
  if ($("[name='autosave']").prop("checked") == true) {
    save_character();
  }

  // Load character
  var file = e.target.files[0];
  if (!file) {
    return;
  }
  var reader = new FileReader();
  reader.onload = function(e) {
    var contents = e.target.result;

    // Set size of dynamic tables
    var savedData = JSON.parse(contents);
    
    while (rows_attacks > parseInt(savedData.rows_attacks)) {
      remove_last_row('attacktable');
    }
    while (rows_attacks < parseInt(savedData.rows_attacks)) {
      add_attack();
    }
    
    while (rows_attunements > parseInt(savedData.rows_attunements)) {
      remove_last_row('attunementtable');
    }
    while (rows_attunements < parseInt(savedData.rows_attunements)) {
      add_attunement();
    }

    while (rows_inventory > parseInt(savedData.rows_inventory)) {
      remove_last_row('inventorytable');
    }
    while (rows_inventory < parseInt(savedData.rows_inventory)) {
      add_inventory();
    }

    while (rows_spells > parseInt(savedData.rows_spells)) {
      remove_last_row('spelltable');
    }
    while (rows_spells < parseInt(savedData.rows_spells)) {
      add_spell();
    }
    
    // Prepare form data for JSON format
    const formId = "charsheet";
    var url = location.href;
    const formIdentifier = `${url} ${formId}`;
    let form = document.querySelector(`#${formId}`);
    let formElements = form.elements;

    // Display file content
    savedData = JSON.parse(contents); // get and parse the saved data from localStorage
    for (const element of formElements) {
      if (element.name in savedData) {
        if (element.type == 'checkbox') {
          var checked = (savedData[element.name] == 'checked');
          $("[name='" + element.name + "']").prop("checked", checked)
        } else {
          element.value = savedData[element.name]; 
        }
      }
    }
  };
  reader.readAsText(file);
}
document.getElementById('buttonload').addEventListener('change', load_character, false);

function long_rest()
{
  console.log("Taking long rest...")
  /*
   *  To do on a long rest:
   * 
   *  x Reset hit points to max HP
   *  x Reset hit dice to max hit dice
   *  x Reset all spell slots available to max
   *  x Reset all death saves
   *  x Remind player to reset temp HP and limited use features and items
   *  
   */


  $("[name='currenthp']").val($("[name='maxhp']").val())
  $("[name='remaininghd']").val($("[name='totalhd']").val())

  $("[name='spellslots1']").val($("[name='spellslotsmax1']").val())
  $("[name='spellslots2']").val($("[name='spellslotsmax2']").val())
  $("[name='spellslots3']").val($("[name='spellslotsmax3']").val())
  $("[name='spellslots4']").val($("[name='spellslotsmax4']").val())
  $("[name='spellslots5']").val($("[name='spellslotsmax5']").val())
  $("[name='spellslots6']").val($("[name='spellslotsmax6']").val())
  $("[name='spellslots7']").val($("[name='spellslotsmax7']").val())
  $("[name='spellslots8']").val($("[name='spellslotsmax8']").val())
  $("[name='spellslots9']").val($("[name='spellslotsmax9']").val())
  $("[name='pactslots1']").val($("[name='pactslotsmax1']").val())

  $("[name='deathsuccess1']").prop("checked", false);
  $("[name='deathsuccess2']").prop("checked", false);
  $("[name='deathsuccess3']").prop("checked", false);
  $("[name='deathfail1']").prop("checked", false);
  $("[name='deathfail2']").prop("checked", false);
  $("[name='deathfail3']").prop("checked", false);

  alert("Hit points, hit dice, and spell slots have been refreshed.\n\nPlease remember to reset Limited Use abilities, temporary hit points, and other effects as needed.")
}

function add_attack()
{
  var tableRef = document.getElementById('attacktable')

  var row = tableRef.insertRow(tableRef.rows.length)

  var cell0 = row.insertCell(0);
  var cell1 = row.insertCell(1);
  var cell2 = row.insertCell(2);
  var cell3 = row.insertCell(3);

  cell0.innerHTML = "<td><input name='atkname" + rows_attacks + "' type='text'/></td>";
  cell1.innerHTML = "<td><input name='atkbonus" + rows_attacks + "' type='text'/></td>";
  cell2.innerHTML = "<td><input name='atkdamage" + rows_attacks + "' type='text'/></td>";
  cell3.innerHTML = "<td colspan='2'><input name='atknotes" + rows_attacks + "' type='text'/></td>";

  rows_attacks += 1;
  $("[name='rows_attacks']").val(rows_attacks);
}

function add_spell()
{
  var tableRef = document.getElementById('spelltable')

  var row = tableRef.insertRow(tableRef.rows.length)

  var cell0 = row.insertCell(0);
  var cell1 = row.insertCell(1);
  var cell2 = row.insertCell(2);
  var cell3 = row.insertCell(3);
  var cell4 = row.insertCell(4);
  var cell5 = row.insertCell(5);
  var cell6 = row.insertCell(6);
  var cell7 = row.insertCell(7);
  var cell8 = row.insertCell(8);
  var cell9 = row.insertCell(9);

  cell0.innerHTML = "<td><input name='spellprep" + rows_spells + "' type='checkbox' /></td>";
  cell1.innerHTML = "<td><input name='spellname" + rows_spells + "' type='text' /></td>";
  cell2.innerHTML = "<td><input name='spelllevel" + rows_spells + "' type='text' /></td>";
  cell3.innerHTML = "<td><input name='spellsource" + rows_spells + "' type='text' /></td>";
  cell4.innerHTML = "<td><input name='spellattacksave" + rows_spells + "' type='text' /></td>";
  cell5.innerHTML = "<td><input name='spelltime" + rows_spells + "' type='text' /></td>";
  cell6.innerHTML = "<td><input name='spellrange" + rows_spells + "' type='text' /></td>";
  cell7.innerHTML = "<td><input name='spellduration" + rows_spells + "' type='text' /></td>";
  cell8.innerHTML = "<td><input name='spellcomponents" + rows_spells + "' type='text' /></td>";
  cell9.innerHTML = "<td><input name='spellnotes" + rows_spells + "' type='text' /></td>";

  rows_spells += 1;
  $("[name='rows_spells']").val(rows_spells);
}

function add_inventory()
{
  var tableRef = document.getElementById('inventorytable')

  var row = tableRef.insertRow(tableRef.rows.length)

  var cell0 = row.insertCell(0);
  var cell1 = row.insertCell(1);
  var cell2 = row.insertCell(2);
  var cell3 = row.insertCell(3);
  var cell4 = row.insertCell(4);
  var cell5 = row.insertCell(5);

  cell0.innerHTML = "<td><input name='itemequipped" + rows_inventory + "' type='checkbox' /></td>";
  cell1.innerHTML = "<td><input name='itemname" + rows_inventory + "' type='text' /></td>";
  cell2.innerHTML = "<td><input name='itemcount" + rows_inventory + "' type='text' onchange='calc_carry_weight()' /></td>";
  cell3.innerHTML = "<td><input name='itemweight" + rows_inventory + "' type='text' onchange='calc_carry_weight()' /></td>";
  cell4.innerHTML = "<td><input name='itemvalue" + rows_inventory + "' type='text' /></td>";
  cell5.innerHTML = "<td><input name='itemnotes" + rows_inventory + "' type='text' /></td>";

  rows_inventory += 1;
  $("[name='rows_inventory']").val(rows_inventory);
}

function add_attunement()
{
  var tableRef = document.getElementById('attunementtable')

  var row = tableRef.insertRow(tableRef.rows.length)

  var cell0 = row.insertCell(0);

  cell0.innerHTML = "<td><input name='attunement" + rows_attunements + "' type='text' /></td>";

  rows_attunements += 1;
  $("[name='rows_attunements']").val(rows_attunements);
}

function remove_last_row(tableId)
{
  var tableRef = document.getElementById(tableId);
  var rowCount = tableRef.rows.length;
  tableRef.deleteRow(rowCount - 1);

  switch(tableId) {
    case 'attacktable':
      rows_attacks -= 1;
      if (rows_attacks < 0) {
        rows_attacks = 0;
      }
      break;
    case 'attunementtable':
      rows_attunements -= 1;
      if (rows_attunements < 0) {
        rows_attunements = 0;
      }
      break;
    case 'inventorytable':
      rows_inventory -= 1;
      if (rows_inventory < 0) {
        rows_inventory = 0;
      }
      break;
    case 'spelltable':
      rows_spells -= 1;
      if (rows_spells < 0) {
        rows_spells = 0;
      }
      break;
  }
  $("[name='rows_attacks']").val(rows_attacks);
  $("[name='rows_attunements']").val(rows_attunements);
  $("[name='rows_inventory']").val(rows_inventory);
  $("[name='rows_spells']").val(rows_spells);
}

function calc_carry_weight()
{
  var total = 0;
  var table = document.getElementById("inventorytable");
  var trs = table.getElementsByTagName('tr');
  for (var i=0; i < trs.length; i++) {
      var tds = trs[i].getElementsByTagName('td');

      var count_str = tds[2].getElementsByTagName('input')[0].value;
      var weight_str = tds[3].getElementsByTagName('input')[0].value;

      var count = (isNaN(parseFloat(count_str)) ? 0 : parseFloat(count_str))
      var weight = (isNaN(parseFloat(weight_str)) ? 0 : parseFloat(weight_str))

      console.log(count + " * " + weight + " = " + (count * weight));
      total += count * weight;
  }
  document.getElementById("weightcarried").value = parseInt(total + 0.5);
}