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