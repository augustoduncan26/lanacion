# lanacion
Test La Nacion
Para poder reproducir la app, siga los siguientes pasos:

- Descargar todos los archivos desde el repo o clonandolo desde el siguiente enlace
https://github.com/augustoduncan26/lanacion.git

- Crear una base dato llamada: starships
Crear las siguientes dos tablas

CREATE TABLE `starships` (
  `_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `model` varchar(100) DEFAULT NULL,
  `starship_class` varchar(100) NOT NULL,
  `manufacturer` varchar(100) NOT NULL,
  `cost_in_credits` varchar(100) NOT NULL,
  `length` varchar(100) NOT NULL,
  `crew` varchar(100) NOT NULL,
  `passengers` varchar(100) NOT NULL,
  `max_atmosphering_speed` varchar(100) NOT NULL,
  `hyperdrive_rating` varchar(100) NOT NULL,
  `MGLT` varchar(100) NOT NULL,
  `cargo_capacity` varchar(100) NOT NULL,
  `consumables` varchar(100) NOT NULL,
  `films` varchar(100) NOT NULL,
  `pilots` longtext NOT NULL,
  `url` longtext NOT NULL,
  `created` varchar(100) NOT NULL,
  `edited` varchar(100) NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `vehicles` (
  `_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `manufacturer` varchar(100) NOT NULL,
  `cost_in_credits` varchar(100) NOT NULL,
  `length` varchar(100) NOT NULL,
  `max_atmosphering_speed` varchar(100) NOT NULL,
  `crew` varchar(100) NOT NULL,
  `passengers` varchar(100) NOT NULL,
  `cargo_capacity` varchar(100) NOT NULL,
  `consumables` varchar(100) NOT NULL,
  `vehicle_class` varchar(100) NOT NULL,
  `pilots` longtext NOT NULL,
  `films` longtext NOT NULL,
  `created` varchar(100) NOT NULL,
  `edited` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

Luego de descargar los archivos y copiarlos a su localhost personal, al correr por primera vez la app se conectara a la API: Swapi para descargar los datos para cada tabla.



