-- Données de démonstration pour TomTroc (MVP)
-- À exécuter après migrations/schema.sql.
-- Comptes de test :
-- alice@example.com / tomtroc123
-- bob@example.com / lecteur123
-- claire@example.com / bibliophile123

SET NAMES utf8mb4;

START TRANSACTION;

INSERT INTO users (id, username, email, password) VALUES
    (1, 'Alice', 'alice@example.com', '$2y$10$ykNj5bb6GGUYZxBeHKGJkOFDqZAeIBuXM2ozM8Nt77WI/CYtE84Ty'),
    (2, 'Bob', 'bob@example.com', '$2y$10$LYKNXiBjXrxYXxB1GmzAEeIQ99UWZcCPVa27c./QoFnjsX6A.tGuq'),
    (3, 'Claire', 'claire@example.com', '$2y$10$auxfo/qmYeXRObvjf/Ogh.8433xEKeD13yCYXYFjzAjNqkqNj6LVG');

INSERT INTO books (id, user_id, title, author, image, description, status) VALUES
    (1, 1, 'Le Petit Prince', 'Antoine de Saint-Exupéry', NULL,
        'Un grand classique de la littérature à redécouvrir.', 'available'),
    (2, 1, 'L''Étranger', 'Albert Camus', NULL,
        'Roman en très bon état, quelques traces d''usage sur la couverture.', 'available'),
    (3, 1, 'Dune', 'Frank Herbert', NULL,
        'Édition de poche. Livre conservé dans une bibliothèque non-fumeur.', 'unavailable'),
    (4, 2, 'Harry Potter à l''école des sorciers', 'J. K. Rowling', NULL,
        'Première aventure de Harry Potter, en bon état.', 'available'),
    (5, 2, '1984', 'George Orwell', NULL,
        'Un roman incontournable de science-fiction dystopique.', 'available'),
    (6, 3, 'La Peste', 'Albert Camus', NULL,
        'Livre annoté avec soin, prêt à rejoindre une nouvelle bibliothèque.', 'available'),
    (7, 3, 'Le Comte de Monte-Cristo', 'Alexandre Dumas', NULL,
        'Version en deux tomes, pages en bon état.', 'unavailable');

INSERT INTO messages (id, sender_id, receiver_id, content) VALUES
    (1, 2, 1, 'Bonjour Alice, votre exemplaire du Petit Prince est-il toujours disponible ?'),
    (2, 1, 2, 'Bonjour Bob, oui, il est toujours disponible. Quel livre proposez-vous en échange ?'),
    (3, 2, 1, 'Je peux vous proposer 1984, qui est aussi dans ma bibliothèque.'),
    (4, 3, 1, 'Bonjour Alice, je suis intéressée par L''Étranger. Souhaitez-vous en discuter ?'),
    (5, 1, 3, 'Bonjour Claire, avec plaisir. Votre exemplaire de La Peste m''intéresse également.'),
    (6, 1, 2, 'Bonjour Bob, je vous confirme que le livre est toujours disponible.');

COMMIT;
