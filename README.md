# Sklep internetowy Filolek
autor: Konrad Tatomir

Sklep z przyboerami szkolnymi, zabawkami i innymi rzeczami codziennego urztku.

## Spis Treści

- [Technologie]
- [Instalacja]
- [Wymagania]
- [Struktura_Projektu]
- [Application_Features]

## Technologie
Projekt został zrealizowany przy użyciu następujących technologii:

## Instalacja
Skopiuj repozyarium na swój serwer
nalerzy użuć polecenia: docker-compose up
natepnie połaczyć sie przez localhost w przegladarce
- localhost:8080 --strona
- localhost:5050 --baza danych

## Wymagania
PHP 7.4 or higher
A web server (e.g., Apache, NGINX)



- **PHP**: Język programowania serwerowej logiki biznesowej.
- **pgAdmin**: Narzędzie do zarządzania bazą danych PostgreSQL.
- **Docker**: Platforma do konteneryzacji i uruchamiania aplikacji w izolowanych środowiskach.
- **HTML/CSS/JS**: Języki używane do tworzenia interfejsu użytkownika i dynamicznej zawartości strony.
- **CDD (Continuous Deployment and Delivery)**: Metodologia automatycznego dostarczania i wdrażania zmian w kodzie.





## Struktura_Projektu

- **public/**: Ten folder zawiera pliki, które są dostępne publicznie, takie jak pliki PHP, CSS, JS, obrazy, itp.

- **src/**: W tym folderze znajduje się cały kod źródłowy aplikacji PHP. Jest podzielony na podfoldery:

  - **controllers/**: Kontrolery obsługujące żądania HTTP i przekazujące odpowiednie dane do serwisów.

  - **repository/**: Repozytoria zajmujące się dostępem do bazy danych.

  - **views/**: Szablony widoków renderowane przez kontrolery.

- **docker/**: W tym folderze znajdują się pliki konfiguracyjne Docker, takie jak Dockerfile, docker-compose.yml.


- **README.md**: Aktualny plik README.md, dostarczający dokumentację projektu.


## Application_Features

- Uwierzytelnianie użytkownika: Bezpieczne logowanie i zarządzanie sesją.
- Zarządzanie Produktami: Dodawanie, usuwanie i możliwość zakupu produktów ze sklepu.
- Profile użytkowników: Przeglądaj i edytuj informacje o użytkownikach oraz dostosowuj profile.
- Funkcje admina: Przeglądaj użytkowników i ich zamówienia.

```bash
git clone https://github.com/Kondro571/Project_WdPAI-Fijolek.git
cd Project_WdPAI-Fijolek


