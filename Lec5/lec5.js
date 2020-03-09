class benimTarihim{
    constructor(date){
        this.date = date;
        this.months = ["Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"];
        this.days = ["Pazartesi", "Salı", "Çarşamba", "Perşembe", "Cume", "Cumartesi", "Pazar"]
    }

    GetMonth() {
        return this.months[this.date.getMonth()];
    }

    GetDay(){
        return this.days[this.date.getDay() - 1];
    }
}
var x = 5;
function useGlobal(){
    let x = 7;
    console.log(x);
    
    return global;
}
console.log(x);


function globalVar() {
    global = "without var it is global";
}