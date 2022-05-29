CREATE TABLE users (
	id int primary key auto_increment,
    nome varchar(255) not null,
    cognome varchar(255) not null,
    username varchar(16) not null unique,
    email varchar(255) not null,
    password varchar(255) not null
) engine = 'InnoDB';

CREATE TABLE contents (
	id int primary key auto_increment,
    titolo varchar(255) not null,
    url varchar(255) not null,
    descrizione varchar(255) not null
) engine = 'InnoDB';

CREATE TABLE prefers (
	userId int not null,
    id int not null,
    immagine varchar(255) not null,
    titolo varchar(255) not null,
    descrizione varchar(255) not null,
    primary key(userId, id),
    
    INDEX ind_userId(userId),
    FOREIGN KEY (userId) REFERENCES users(id)
) engine = 'InnoDB';

INSERT INTO contents(titolo, url, descrizione) VALUES("Pesce finto", "Images/PesceFinto.jpg", "Antipasto originale e sfizioso, molto semplice da realizzare ma di grande effetto. Si presta a dare spazio alla vena artistica di ciascuno, perché può essere modellato e decorato secondo la vostra fantasia e creatività." );
INSERT INTO contents(titolo, url, descrizione) VALUES("Lasagne al salmone", "Images/LasagneAlSalmone.jpg", "Pensata per i più golosi, stupite i vostri invitati portando a tavola una sfiziosa rivisitazione di uno dei primi piatti più apprezzati della nostra cucina." );
INSERT INTO contents(titolo, url, descrizione) VALUES("Branzino al forno", "Images/BranzinoAlForno.jpg", "Senza aggiunta di troppi ingredienti, per assaporare tutto il sapore del mare nella sua interezza." );
INSERT INTO contents(titolo, url, descrizione) VALUES("Torta alla ricotta e cioccolato", "Images/TortaAllaRicotta.jpg", "La ricotta, uno dei formaggi più utilizzati soprattutto quando si tratta di preparare un dolce! La torta alla ricotta e cioccolato, dolce morbido e consistente, è perfetto da gustare a colazione o a merenda." );
INSERT INTO contents(titolo, url, descrizione) VALUES("Brownies", "Images/Brownies.jpg", "Scioglievoli all’interno e con una leggera crosticina all’esterno, i brownies sono spesso serviti accompagnati con panna montata o gelato alla vaniglia, ma nascono in realtà come dolce da passeggio, facile da trasportare.");
INSERT INTO contents(titolo, url, descrizione) VALUES("Pollo al limone", "Images/PolloAlLimone.jpg", "Tenere striscioline di petto di pollo tuffate in una cremina densa e avvolgente che renderà questo secondo piatto davvero irresistibile e profumato, un'ottima alternativa alle classiche scaloppine.");
INSERT INTO contents(titolo, url, descrizione) VALUES("Polpettine tonno e ricotta", "Images/PolpettineTonnoRicotta.jpg", "Un modo diverso per mangiare il solito tonno sott'olio,  ricetta molto appetitosa, indicate da servire calde sia come antipasto che come secondo piatto");
INSERT INTO contents(titolo, url, descrizione) VALUES("Penne al baffo", "Images/PenneAlBaffo.jpg", "Ricetta perfetta da preparare per un pranzo in famiglia o con amici, quando si ha poco tempo per cucinare ma tanta voglia di qualcosa di sfizioso");
INSERT INTO contents(titolo, url, descrizione) VALUES("Mozzarella in carrozza", "Images/MozzarelleInCarrozza.jpg", "Ricetta sfiziosa, nasce come una ricetta di riciclo per consumare tutto ciò che rimane dal pranzo precedente e trasformarlo in qualcosa di veramente appetitoso!");
INSERT INTO contents(titolo, url, descrizione) VALUES("Pasta alla Sorrentina", "Images/PastaAllaSorrentina.jpg", "Il saporito condimento di questo primo piatto ci ha conquistati: corposo pomodoro, profumato basilico e mozzarella filante… La pasta alla sorrentina è una pietanza vegetariana scenografica e succulenta da condividere con tutta la famiglia!");




