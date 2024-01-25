-- Tworzenie tabeli 'uzytkownik'
CREATE TABLE uzytkownik (
    id SERIAL PRIMARY KEY,
    email VARCHAR(50) unique CHECK (email LIKE '%@%'),,
    haslo VARCHAR(50),
    poprzednie_haslo VARCHAR(50)
    isadmin boolean
);
-- Tworzenie tabeli 'szcegoly_uzytkowinka'
CREATE TABLE szcegoly_uzytkownika (
    id SERIAL PRIMARY KEY,
    uzytkownik_id INT,
    imie VARCHAR(20),
    nazwisko VARCHAR(30),
    miasto VARCHAR(60),
    ulica VARCHAR(60),
    numer int,
    kod_pocztowy VARCHAR(6),
    telefon int,
    FOREIGN KEY (uzytkownik_id) REFERENCES uzytkownik(id)
);

-- Tworzenie tabeli 'zamowienia'
CREATE TABLE zamowienia (
    id SERIAL PRIMARY KEY,
    data_ DATE,
    uzytkownik_id INT,
    miejscowosc VARCHAR(60),
    ulica VARCHAR(60),
    kod_pocztowy VARCHAR(6) CHECK(postal_code LIKE'^[0-9]{2}-[0-9]{3}$') not null,
    data_platnosci DATE,
    kwota NUMERIC,
    status_ VARCHAR(20),
    FOREIGN KEY (uzytkownik_id) REFERENCES uzytkownik(id)
);

-- Tworzenie tabeli 'kategoria'
CREATE TABLE kategoria (
    id SERIAL PRIMARY KEY,
    nazwa VARCHAR(50),
    pogkategoria VARCHAR(50),
    opis VARCHAR(50),
    UNIQUE(nazwa)
);





CREATE TABLE podkategoria (
    id SERIAL PRIMARY KEY,
    nazwa VARCHAR(50),
    kategoria_id INT,
    FOREIGN KEY (kategoria_id) REFERENCES kategoria(id)
);

-- Tworzenie tabeli 'zdjecia_produktow'
CREATE TABLE zdjecia_produktow (
    id SERIAL PRIMARY KEY,
    sciezka_do_zdjecia VARCHAR(255),
    opis VARCHAR(255),
    produkt_id INT,
    FOREIGN KEY (produkt_id) REFERENCES produkty(id)
);

-- Tworzenie tabeli 'produkty'
CREATE TABLE produkty (
    id SERIAL PRIMARY KEY,
	nazwa VARCHAR(70),
    producent VARCHAR(50),
    cena NUMERIC,
    kategoria_id INT,
    ilosc INTEGER,
    FOREIGN KEY (kategoria_id) REFERENCES kategoria(id)
);

-- Tworzenie tabeli 'zeszyty'
CREATE TABLE zeszyty (
    id SERIAL PRIMARY KEY,
    rodzaj VARCHAR(20),
    ilosc_kartek INTEGER,
    rozmiar VARCHAR(20),
    produkt_id INT,
    FOREIGN KEY (produkt_id) REFERENCES produkty(id)
);

-- Tworzenie tabeli 'dlugopisu'
CREATE TABLE dlugopisy (
    id SERIAL PRIMARY KEY,
    kolor VARCHAR(20),
    produkt_id INT,
    FOREIGN KEY (produkt_id) REFERENCES produkty(id)
);

-- Tworzenie tabeli 'szczegoly_zamowien'
CREATE TABLE szczegoly_zamowien (
    id SERIAL PRIMARY KEY,
    zamowienie_id INT,
    produkt_id INT,
    ilosc INT,
    FOREIGN KEY (zamowienie_id) REFERENCES zamowienia(id),
    FOREIGN KEY (produkt_id) REFERENCES produkty(id)
);



CREATE TABLE produkty_kategorie (
    produkt_id INT,
    kategoria_id INT,
    PRIMARY KEY (produkt_id, kategoria_id),
    FOREIGN KEY (produkt_id) REFERENCES produkty(id),
    FOREIGN KEY (kategoria_id) REFERENCES kategoria(id)
);

CREATE TABLE koszyk (
    id SERIAL PRIMARY KEY,
    uzytkownik_id INT,
    produkt_id INT,
    ilosc INTEGER,
    FOREIGN KEY (uzytkownik_id) REFERENCES uzytkownik(id),
    FOREIGN KEY (produkt_id) REFERENCES produkty(id)
);

SELECT constraint_name 
FROM information_schema.constraint_column_usage 
WHERE table_name = 'kategoria' AND column_name = 'nazwa';


-- funkcja
DECLARE
    total NUMERIC;
BEGIN
    SELECT COALESCE(SUM(p.cena * k.ilosc), 0)
    INTO total
    FROM koszyk k
    JOIN produkty p ON k.produkt_id = p.id
    WHERE k.uzytkownik_id = "userId";

    RETURN total;
END;

-- trigger 
CREATE OR REPLACE FUNCTION set_default_admin()
RETURNS TRIGGER AS $$
BEGIN
    NEW.isadmin := false;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER set_default_admin_trigger
BEFORE INSERT ON uzytkownik
FOR EACH ROW
EXECUTE FUNCTION set_default_admin();

-- widok
CREATE VIEW widok_produkty_zeszyty AS
SELECT 
    p.id AS produkt_id, 
    p.nazwa AS produkt_nazwa, 
    p.producent AS produkt_producent, 
    p.cena AS produkt_cena, 
    p.ilosc AS produkt_ilosc, 
    z.id AS zeszyt_id,
    z.rodzaj AS zeszyt_rodzaj,
    z.ilosc_kartek AS zeszyt_ilosc_kartek,
    z.rozmiar AS zeszyt_rozmiar,
    zd.sciezka_do_zdjecia AS zdjecie_sciezka
FROM 
    produkty p
LEFT JOIN 
    zeszyty z ON p.id = z.produkt_id
LEFT JOIN
    zdjecia_produktow zd ON p.id = zd.produkt_id;
