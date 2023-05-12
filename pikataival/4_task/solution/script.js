const modifyJSONFile = () => {
  readTextFile("../assets/person.json", function(text){
    var data = JSON.parse(text);

    data.age = 17;
    data.name = "Ano Nyymi";

    download(data, 'person.json', 'text/plain');
  });
};

function readTextFile(file, callback) {
  var rawFile = new XMLHttpRequest();
  rawFile.overrideMimeType("application/json");
  rawFile.open("GET", file, true);
  rawFile.onreadystatechange = function() {
      if (rawFile.readyState === 4 && rawFile.status == "200") {
          callback(rawFile.responseText);
      }
  }
  rawFile.send(null);
}

function download(content, fileName, contentType) {
  var a = document.createElement("a");
  content = JSON.stringify(content);
  var file = new Blob([content], {type: contentType});
  a.href = URL.createObjectURL(file);
  a.download = fileName;
  a.click();
}

modifyJSONFile();
