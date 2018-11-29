# Awareness010

## Locale storage
Get data from locale storage with function
```javascript
parseJson:function() {
    let data = localStorage.getItem('answers');
    if (data){
        let object = JSON.parse(data);
        this.answers = object;
    }
}
```

Return values
```json
{
    "meat": "7",
    "car": 
        { 
            "type": "hybrid_car",
            "km": 250 
        },
    "shower":
        { 
            "days": "7",
            "minutes": "5" 
        },
    "smoke": "5"
}
````

## API

### Get data per category
##### POST
```
/api/compare/{category}
```
Expected question input data

### Examples
#### Meat
```javascript
axios.post('api/compare/meat', {
    `input: 7
})`
```

#### Car
```javascript
axios.post('api/compare/benzine_car', {
    `input: {
        type: "benzine_car",
        km: "250"
    }
```

#### Shower
```javascript
axios.post('api/compare/shower', {
    `input: {
        days: 7,
        minutes: 5
    }
})`
```

#### Smoking
```javascript
axios.post('api/compare/smoke', {
    `input: 10
})`
```


### Return values
```javascript
car: 
    avgDischargeKM: 127
    avgDischargeYear: 828
    usrAnnualDischarge: 1651
    usrBelowAverage: false
    usrWeeklyDischarge: 31750
    usrWeeklyKM: 250
```
