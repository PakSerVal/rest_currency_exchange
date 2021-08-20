# Currency exchange rest service

## Up and running
```bash
git clone https://github.com/PakSerVal/rest_currency_exchange.git
cd rest_currency_exchange
composer install

docker-compose build
docker-compose up -d
```

The app will be upped for localhost::7777

## Api
#### GET /exchange
```bash
curl -i -H "Accept: application/json" -H "X-API-KEY: 123321" http://localhost:7777/exchange
```
Response
```json
{
  "BGN": "1 Болгарский лев равен 44.3964 рублям"
}
```

#### GET /exchange/{currencyCode}
```bash
curl -i -H "Accept: application/json" -H "X-API-KEY: 123321" http://localhost:7777/exchange/CHF
```

Response
```json
{
  "CHF":"1 Швейцарский франк равен 81.0507 рублям"
}
```
