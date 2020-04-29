var totalPrice = new Array();

class phone{
    constructor(brand, model, screenFeatures, camera, cpu, ram, memory, battery, os, extraFeatures, oldPrice, price, pictureAddress){
        this.brand = brand;
        this.model = model;
        this.screenFeatures = screenFeatures;
        this.camera = camera;
        this.cpu = cpu;
        this.ram=ram;
        this.memory = memory;
        this.battery = battery;
        this.os = os;
        this.extraFeatures = extraFeatures;
        this.oldPrice = oldPrice;
        this.price = price;
        this.pictureAddress = pictureAddress;
    }

    GetName(){
        return this.brand + " " + this.model;
    }

    GetPrice(){
        return this.price;
    }

    GetScreen(){
        return this.screenFeatures;
    }

    GetCamera(){
        return this.camera;
    }

    GetCPU(){
        return this.cpu;
    }

    GetRam(){
        return this.ram;
    }

    GetMemory(){
        return this.memory;
    }

    GetBattery(){
        return this.battery;
    }

    GetOS(){
        return this.os;
    }

    GetOldPrice(){
        /*this.oldPrice = <del>this.oldPrice</del>*/
        return this.oldPrice;
    }

    GetExtras(){
        return this.extraFeatures;
    }

    GetPicture(){
        return this.pictureAddress;
    }
}

function emptyErrorControl(element){
    try{
        if(element == "") throw "Lütfen tüm değerleri giriniz! ";
    }catch(error){
        alert(error)
    }
}

function numberErrorControl(){
    try{
        if(element == "") throw "Lütfen tüm değerleri giriniz! ";
        if(isNaN(element)) throw "Girilen değer sayı değil! ";
        return true;
    }catch(error){
        alert(error);
        return false;
    }
}

function placedBest(item){
    var divProduct = document.createElement('div');
        divProduct.setAttribute('class', 'bestProduct');
        document.getElementById('best').appendChild(divProduct);
        
        var divOfLeft = document.createElement('div');
        divOfLeft.setAttribute('class', 'bestLeft');
        divProduct.appendChild(divOfLeft);
        var imageOfProduct = document.createElement('img');
        imageOfProduct.src = item.GetPicture();
        divOfLeft.appendChild(imageOfProduct);

        var divFeatures = document.createElement('div');
        divFeatures.setAttribute('class', 'bestRight');
        divProduct.appendChild(divFeatures);
        var ulOfFeature = document.createElement('ul');
        ulOfFeature.setAttribute('class', 'bestFeatureList');
        divFeatures.appendChild(ulOfFeature);

        var liName = document.createElement('h4');
        var nodeName = document.createTextNode(item.GetName());
        liName.appendChild(nodeName);
        ulOfFeature.appendChild(liName);

        var liScreen = document.createElement('li');
        var nodeScreen = document.createTextNode(item.GetScreen());
        liScreen.appendChild(nodeScreen);
        ulOfFeature.appendChild(liScreen);
        
        var liCamera = document.createElement('li');
        var nodeCamera = document.createTextNode(item.GetCamera() + ' MP');            
        liCamera.appendChild(nodeCamera);
        ulOfFeature.appendChild(liCamera);

        var liCPU = document.createElement('li');
        var nodeCPU = document.createTextNode(item.GetCPU());            
        liCPU.appendChild(nodeCPU);
        ulOfFeature.appendChild(liCPU);

        var liRam = document.createElement('li');
        var nodeRam = document.createTextNode(item.GetRam() + ' GB');            
        liRam.appendChild(nodeRam);
        ulOfFeature.appendChild(liRam);

        var liMemory = document.createElement('li');
        var nodeMemory = document.createTextNode(item.GetMemory() + ' GB');            
        liMemory.appendChild(nodeMemory);
        ulOfFeature.appendChild(liMemory);

        var liBattery = document.createElement('li');
        var nodeBattery = document.createTextNode(item.GetBattery() + ' mAh');            
        liBattery.appendChild(nodeBattery);
        ulOfFeature.appendChild(liBattery);

        var liOS = document.createElement('li');
        var nodeOS = document.createTextNode(item.GetOS());            
        liOS.appendChild(nodeOS);
        ulOfFeature.appendChild(liOS);

        var liExtras = document.createElement('li');
        var nodeExtras = document.createTextNode(item.GetExtras());            
        liExtras.appendChild(nodeExtras);
        ulOfFeature.appendChild(liExtras);

        var ulPrice = document.createElement('ul');    
        ulPrice.setAttribute('class', 'bestPriceUL')     
        ulOfFeature.appendChild(ulPrice);

        var liFiyat = document.createElement('li');
        var nodeOfFiyat = document.createTextNode('Fiyatı: ');
        liFiyat.appendChild(nodeOfFiyat);
        ulPrice.appendChild(liFiyat)

        var liOldPrice = document.createElement('li');
        var delTag = document.createElement('del');
        var nodeOldPrice = document.createTextNode(item.GetOldPrice() + ' ₺'); 
        delTag.appendChild(nodeOldPrice);  
        liOldPrice.appendChild(delTag);
        ulPrice.appendChild(liOldPrice);

        var liPrice = document.createElement('li');
        var nodePrice = document.createTextNode('  ' + item.GetPrice() + ' ₺');            
        liPrice.appendChild(nodePrice);
        ulPrice.appendChild(liPrice);

        var liBasketButton = document.createElement('button');
        var nodeOfBasket = document.createTextNode('İncele');
        liBasketButton.appendChild(nodeOfBasket);
        ulPrice.appendChild(liBasketButton);
}

function placedProduct(item, indexOfItem){
    var divProduct = document.createElement('div');
    divProduct.setAttribute('class', 'product');
    document.getElementById('allProducts').appendChild(divProduct);
    
    var divOfLeft = document.createElement('div');
    divOfLeft.setAttribute('class', 'left');
    divProduct.appendChild(divOfLeft);
    var imageOfProduct = document.createElement('img');
    imageOfProduct.src = item.GetPicture();
    divOfLeft.appendChild(imageOfProduct);

    var divFeatures = document.createElement('div');
    divFeatures.setAttribute('class', 'right');
    divProduct.appendChild(divFeatures);
    var ulOfFeature = document.createElement('ul');
    ulOfFeature.setAttribute('class', 'featureList');
    divFeatures.appendChild(ulOfFeature);

    var liName = document.createElement('h4');
    var nodeName = document.createTextNode(item.GetName());
    liName.appendChild(nodeName);
    ulOfFeature.appendChild(liName);

    var liScreen = document.createElement('li');
    var nodeScreen = document.createTextNode(item.GetScreen());
    liScreen.appendChild(nodeScreen);
    ulOfFeature.appendChild(liScreen);
    
    var liCamera = document.createElement('li');
    var nodeCamera = document.createTextNode(item.GetCamera() + ' MP');            
    liCamera.appendChild(nodeCamera);
    ulOfFeature.appendChild(liCamera);

    var liCPU = document.createElement('li');
    var nodeCPU = document.createTextNode(item.GetCPU());            
    liCPU.appendChild(nodeCPU);
    ulOfFeature.appendChild(liCPU);

    var liRam = document.createElement('li');
    var nodeRam = document.createTextNode(item.GetRam() + ' GB');            
    liRam.appendChild(nodeRam);
    ulOfFeature.appendChild(liRam);

    var liMemory = document.createElement('li');
    var nodeMemory = document.createTextNode(item.GetMemory() + ' GB');            
    liMemory.appendChild(nodeMemory);
    ulOfFeature.appendChild(liMemory);

    var liBattery = document.createElement('li');
    var nodeBattery = document.createTextNode(item.GetBattery() + ' mAh');            
    liBattery.appendChild(nodeBattery);
    ulOfFeature.appendChild(liBattery);

    var liOS = document.createElement('li');
    var nodeOS = document.createTextNode(item.GetOS());            
    liOS.appendChild(nodeOS);
    ulOfFeature.appendChild(liOS);

    var liExtras = document.createElement('li');
    var nodeExtras = document.createTextNode(item.GetExtras());            
    liExtras.appendChild(nodeExtras);
    ulOfFeature.appendChild(liExtras);

    var ulPrice = document.createElement('ul');    
    ulPrice.setAttribute('class', 'priceUL')     
    ulOfFeature.appendChild(ulPrice);

    var liFiyat = document.createElement('li');
    var nodeOfFiyat = document.createTextNode('Fiyatı: ');
    liFiyat.appendChild(nodeOfFiyat);
    ulPrice.appendChild(liFiyat)

    var liOldPrice = document.createElement('li');
    var delTag = document.createElement('del');
    var nodeOldPrice = document.createTextNode(item.GetOldPrice() + ' ₺'); 
    delTag.appendChild(nodeOldPrice);  
    liOldPrice.appendChild(delTag);
    ulPrice.appendChild(liOldPrice);

    var liPrice = document.createElement('li');
    var nodePrice = document.createTextNode('  ' + item.GetPrice() + ' ₺');            
    liPrice.appendChild(nodePrice);
    ulPrice.appendChild(liPrice);

    var liBasketButton = document.createElement('button');
    liBasketButton.setAttribute('id',indexOfItem);
    liBasketButton.setAttribute('onclick','var idIndividual = parseInt(this.id);var productForBasket = phoneList[idIndividual];'+ 
    ' addToBasket(productForBasket, idIndividual); totalPrice.push(productForBasket.GetPrice());' + 
    'var total = 0; for(var j = 0; j<totalPrice.length; j++)' +
    '{ total += totalPrice[j];}; document.getElementById("totalCost").innerHTML = total + " ₺";');
    var nodeOfBasket = document.createTextNode('Sepete Ekle');
    var linkToSepet = document.createElement('a');
    linkToSepet.setAttribute('href','#sepetim');
    linkToSepet.appendChild(nodeOfBasket);
    liBasketButton.appendChild(linkToSepet);

    ulPrice.appendChild(liBasketButton);
}

function addToBasket(elementToBasket, indexOfBasket){
    var divProductBasket = document.createElement('div');
    divProductBasket.setAttribute('class','productInBasket');
    divProductBasket.setAttribute('id','parentBasket'+ indexOfBasket);
    document.getElementById('sepetim').appendChild(divProductBasket);

    var imgOfProductBasket = document.createElement('img');
    imgOfProductBasket.src = elementToBasket.GetPicture();
    imgOfProductBasket.setAttribute('class','photoOfBasket');
    divProductBasket.appendChild(imgOfProductBasket);

    var ulInfoBasket = document.createElement('ul');
    ulInfoBasket.setAttribute('class','infoContainer');
    divProductBasket.appendChild(ulInfoBasket);

    var h5NameBasket = document.createElement('h5');
    var nodeNameBasket = document.createTextNode(elementToBasket.GetName());
    h5NameBasket.appendChild(nodeNameBasket);
    ulInfoBasket.appendChild(h5NameBasket);

    var liPriceBasket = document.createElement('li');
    var nodePriceBasket = document.createTextNode(elementToBasket.GetPrice() + " ₺");
    liPriceBasket.appendChild(nodePriceBasket);
    ulInfoBasket.appendChild(liPriceBasket);

    var buttonDeleteBasket = document.createElement('button');
    buttonDeleteBasket.setAttribute('class','deleteFromBasket');
    buttonDeleteBasket.setAttribute('onclick','document.getElementById("parentBasket'+indexOfBasket+
    '").remove();if(document.getElementById("sepetim").childElementCount == 1){document.getElementById("buyDiv").style.visibility = "hidden"; document.getElementById("paymentType").style.visibility ="hidden";}');
    var nodeDelete = document.createTextNode("Sil");
    buttonDeleteBasket.appendChild(nodeDelete);
    divProductBasket.appendChild(buttonDeleteBasket);

    document.getElementById('buyDiv').style.visibility = 'visible';
}

function listProducts(elementToBasket, indexOfBasket){
    var divProductBasket = document.createElement('div');
    divProductBasket.setAttribute('class','productInBasket');
    divProductBasket.setAttribute('id','parentBasket'+ indexOfBasket);
    document.getElementById('sepetim').appendChild(divProductBasket);

    var imgOfProductBasket = document.createElement('img');
    imgOfProductBasket.src = elementToBasket.GetPicture();
    imgOfProductBasket.setAttribute('class','photoOfBasket');
    divProductBasket.appendChild(imgOfProductBasket);

    var ulInfoBasket = document.createElement('ul');
    ulInfoBasket.setAttribute('class','infoContainer');
    divProductBasket.appendChild(ulInfoBasket);

    var h5NameBasket = document.createElement('h5');
    var nodeNameBasket = document.createTextNode(elementToBasket.GetName());
    h5NameBasket.appendChild(nodeNameBasket);
    ulInfoBasket.appendChild(h5NameBasket);

    var liPriceBasket = document.createElement('li');
    var nodePriceBasket = document.createTextNode(elementToBasket.GetPrice() + " ₺");
    liPriceBasket.appendChild(nodePriceBasket);
    ulInfoBasket.appendChild(liPriceBasket);

    var buttonDeleteBasket = document.createElement('button');
    buttonDeleteBasket.setAttribute('class','deleteFromBasket');
    buttonDeleteBasket.setAttribute('onclick','document.getElementById("parentBasket'+indexOfBasket+
    '").remove();if(document.getElementById("sepetim").childElementCount == 1){document.getElementById("buyDiv").style.visibility = "hidden"; document.getElementById("paymentType").style.visibility ="hidden";}');
    var nodeDelete = document.createTextNode("Sil");
    buttonDeleteBasket.appendChild(nodeDelete);
    divProductBasket.appendChild(buttonDeleteBasket);

    document.getElementById('buyDiv').style.visibility = 'visible';
}