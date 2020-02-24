function sum(val1, val2){
    return val1 + val2;
}

function sumOfArrays(array){
    var sumOf = 0;
    for(var i = 0; i < array.length; i++){
        sumOf += array[i];
    }
    return sumOf;
}

function findSmallest(list){
    smallest = list[0];
    for(var i = 0; i < list.length; i++){
        if(smallest > list[i]){
            smallest = list[i];
        }
    }
    return smallest;
}

function findIndexOfSmallest(list, fromIndex){
    var smallestindex = fromIndex;
    for(var i = fromIndex; i < list.length; i++){
        if(list[i] < list[smallestindex]){
            smallestindex = i;
        }
    }
    return smallestindex;
}

function selectionSort(list){
    var smallestindex = 0;
    for(var i = 0; i < list.length; i++){
        smallestindex = findIndexOfSmallest(list, i);
        smallest = list[smallestindex]
        swap = list[i];
        list[i] = smallest;
        list[smallestindex] = swap;
    }
    return list;
}

function pop(list){
    return list[-1];
}

function push(list, elem){
    list[list.length] = elem
    return list;
}

function replaceAll(stringEx, letter1, letter2){
    for(var i = 0; i < stringEx.length; i++){
        if(stringEx[i] == letter1){
            stringEx = stringEx.replace(letter1,letter2);
        }
    }
    return stringEx;
}
