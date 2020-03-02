function splitText(names, splitCharacter){
    var namesArray = names.split(splitCharacter);
    return namesArray;
}

function printOnebyOne(list, seperater){
    var result = "";
    for(var i = 0; i < list.length;i++){
        result += list[i] + seperater;
    }
    return result;
}