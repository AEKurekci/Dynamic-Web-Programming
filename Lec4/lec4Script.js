var students = new Array();
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

class student{
    constructor(name, grades){
        this.name = name;
        this.gradeList = grades;
    }
    ToString(){
        return this.name + "'s grades are " + this.gradeList + " and average is " + this.Average();
    }

    GetGrades(){
        return this.gradeList;
    }

    GetName(){
        return this.name;
    }



    Average(){
        var sum = 0;
        for(var i = 0; i< this.gradeList.length; i++){
            sum += parseInt(this.gradeList[i]);
        }
        return sum/this.gradeList.length;
    }
}

/* class sample
*class car{
    var carname;
    constructor(param){
        this.carname = param;
    }
    methodName(){
        return this.carname;
    }
}
*/