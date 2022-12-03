-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 03 Ara 2022, 15:35:07
-- Sunucu sürümü: 8.0.27
-- PHP Sürümü: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `websitesi`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bloglar`
--

DROP TABLE IF EXISTS `bloglar`;
CREATE TABLE IF NOT EXISTS `bloglar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `resim` varchar(150) COLLATE utf8_turkish_ci NOT NULL,
  `baslik` varchar(150) COLLATE utf8_turkish_ci NOT NULL,
  `icerik` text COLLATE utf8_turkish_ci NOT NULL,
  `tarih` date NOT NULL,
  `ziyaret` int NOT NULL,
  `durum` enum('0','1') COLLATE utf8_turkish_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `bloglar`
--

INSERT INTO `bloglar` (`id`, `resim`, `baslik`, `icerik`, `tarih`, `ziyaret`, `durum`) VALUES
(1, 'img/7.jpg', 'Blog Başlık 1', 'Blog İçerik 1 Lorem ipsum dolor sit, amet consectetur adipisicing elit. Velit cum exercitationem officiis doloremque maxime esse possimus odit, eum minima ad nemo, cumque quos corrupti fugiat sequi numquam itaque natus inventore!\nDicta delectus inventore, quod a tempore temporibus odit, fuga id unde voluptates, consectetur perferendis natus amet architecto officiis distinctio! Inventore dignissimos quasi autem modi mollitia veniam a blanditiis corporis rem?\nNecessitatibus nihil numquam ad magni voluptatem labore quo, odit architecto quaerat adipisci eum quas neque enim sunt voluptate omnis quasi laudantium voluptates sed! Eos nihil aliquid exercitationem ut at modi!\nBeatae hic aliquid vitae vel aliquam repellendus velit cum aspernatur facilis accusamus accusantium obcaecati sint unde, enim debitis, totam quasi deserunt dolorum provident deleniti, quod dicta aperiam. Eaque, sequi ullam?\nAmet, in incidunt dolorem dolorum reprehenderit tenetur placeat nam neque hic obcaecati, distinctio blanditiis cumque quae repellat quidem veritatis quibusdam ex, rem beatae maxime nulla recusandae iusto perferendis harum. Asperiores!\nUllam deleniti ipsam quasi asperiores labore rerum, inventore voluptas molestiae corrupti porro illum animi, vero, iure soluta eveniet exercitationem aspernatur illo id reiciendis pariatur praesentium itaque minus nihil facere. Corporis?\nIllum odit cumque, commodi asperiores deleniti provident sapiente fugit et beatae minus tenetur voluptatibus dolores sint est nobis error culpa, soluta eius laboriosam vitae officiis, inventore mollitia? Unde, deserunt perferendis!\nIncidunt, sapiente obcaecati? Iusto voluptatibus atque saepe id aperiam ad at adipisci maxime recusandae dolores, eum quas commodi labore rem libero accusantium. Porro earum soluta explicabo voluptatibus vero tempore mollitia.\nUllam error deserunt officiis voluptatum magni fugiat culpa neque commodi sunt perspiciatis quisquam placeat quo corrupti beatae inventore doloremque, soluta quam adipisci corporis fugit accusantium dolor nam. Consectetur, tempora atque.\nAsperiores pariatur, architecto, cum aspernatur repudiandae quos natus accusamus eius libero consectetur laboriosam reiciendis? Enim, nemo dolores? Veniam ut deserunt fuga? Quaerat nostrum velit sint quibusdam voluptate modi dicta dignissimos.', '2022-12-03', 2, '0'),
(2, 'img/2.jpg', 'Blog Başlık 2', 'Blog İçerik 2 Lorem ipsum dolor sit, amet consectetur adipisicing elit. Velit cum exercitationem officiis doloremque maxime esse possimus odit, eum minima ad nemo, cumque quos corrupti fugiat sequi numquam itaque natus inventore!\nDicta delectus inventore, quod a tempore temporibus odit, fuga id unde voluptates, consectetur perferendis natus amet architecto officiis distinctio! Inventore dignissimos quasi autem modi mollitia veniam a blanditiis corporis rem?\nNecessitatibus nihil numquam ad magni voluptatem labore quo, odit architecto quaerat adipisci eum quas neque enim sunt voluptate omnis quasi laudantium voluptates sed! Eos nihil aliquid exercitationem ut at modi!\nBeatae hic aliquid vitae vel aliquam repellendus velit cum aspernatur facilis accusamus accusantium obcaecati sint unde, enim debitis, totam quasi deserunt dolorum provident deleniti, quod dicta aperiam. Eaque, sequi ullam?\nAmet, in incidunt dolorem dolorum reprehenderit tenetur placeat nam neque hic obcaecati, distinctio blanditiis cumque quae repellat quidem veritatis quibusdam ex, rem beatae maxime nulla recusandae iusto perferendis harum. Asperiores!\nUllam deleniti ipsam quasi asperiores labore rerum, inventore voluptas molestiae corrupti porro illum animi, vero, iure soluta eveniet exercitationem aspernatur illo id reiciendis pariatur praesentium itaque minus nihil facere. Corporis?\nIllum odit cumque, commodi asperiores deleniti provident sapiente fugit et beatae minus tenetur voluptatibus dolores sint est nobis error culpa, soluta eius laboriosam vitae officiis, inventore mollitia? Unde, deserunt perferendis!\nIncidunt, sapiente obcaecati? Iusto voluptatibus atque saepe id aperiam ad at adipisci maxime recusandae dolores, eum quas commodi labore rem libero accusantium. Porro earum soluta explicabo voluptatibus vero tempore mollitia.\nUllam error deserunt officiis voluptatum magni fugiat culpa neque commodi sunt perspiciatis quisquam placeat quo corrupti beatae inventore doloremque, soluta quam adipisci corporis fugit accusantium dolor nam. Consectetur, tempora atque.\nAsperiores pariatur, architecto, cum aspernatur repudiandae quos natus accusamus eius libero consectetur laboriosam reiciendis? Enim, nemo dolores? Veniam ut deserunt fuga? Quaerat nostrum velit sint quibusdam voluptate modi dicta dignissimos.', '2022-12-03', 1, '0'),
(3, 'img/3.jpg', 'Blog Başlık 3', 'Blog İçerik 3 Lorem ipsum dolor sit, amet consectetur adipisicing elit. Velit cum exercitationem officiis doloremque maxime esse possimus odit, eum minima ad nemo, cumque quos corrupti fugiat sequi numquam itaque natus inventore!\nDicta delectus inventore, quod a tempore temporibus odit, fuga id unde voluptates, consectetur perferendis natus amet architecto officiis distinctio! Inventore dignissimos quasi autem modi mollitia veniam a blanditiis corporis rem?\nNecessitatibus nihil numquam ad magni voluptatem labore quo, odit architecto quaerat adipisci eum quas neque enim sunt voluptate omnis quasi laudantium voluptates sed! Eos nihil aliquid exercitationem ut at modi!\nBeatae hic aliquid vitae vel aliquam repellendus velit cum aspernatur facilis accusamus accusantium obcaecati sint unde, enim debitis, totam quasi deserunt dolorum provident deleniti, quod dicta aperiam. Eaque, sequi ullam?\nAmet, in incidunt dolorem dolorum reprehenderit tenetur placeat nam neque hic obcaecati, distinctio blanditiis cumque quae repellat quidem veritatis quibusdam ex, rem beatae maxime nulla recusandae iusto perferendis harum. Asperiores!\nUllam deleniti ipsam quasi asperiores labore rerum, inventore voluptas molestiae corrupti porro illum animi, vero, iure soluta eveniet exercitationem aspernatur illo id reiciendis pariatur praesentium itaque minus nihil facere. Corporis?\nIllum odit cumque, commodi asperiores deleniti provident sapiente fugit et beatae minus tenetur voluptatibus dolores sint est nobis error culpa, soluta eius laboriosam vitae officiis, inventore mollitia? Unde, deserunt perferendis!\nIncidunt, sapiente obcaecati? Iusto voluptatibus atque saepe id aperiam ad at adipisci maxime recusandae dolores, eum quas commodi labore rem libero accusantium. Porro earum soluta explicabo voluptatibus vero tempore mollitia.\nUllam error deserunt officiis voluptatum magni fugiat culpa neque commodi sunt perspiciatis quisquam placeat quo corrupti beatae inventore doloremque, soluta quam adipisci corporis fugit accusantium dolor nam. Consectetur, tempora atque.\nAsperiores pariatur, architecto, cum aspernatur repudiandae quos natus accusamus eius libero consectetur laboriosam reiciendis? Enim, nemo dolores? Veniam ut deserunt fuga? Quaerat nostrum velit sint quibusdam voluptate modi dicta dignissimos.', '2022-12-03', 2, '0'),
(4, 'img/4.jpg', 'Blog Başlık 4', 'Blog İçerik 4 Lorem ipsum dolor sit, amet consectetur adipisicing elit. Velit cum exercitationem officiis doloremque maxime esse possimus odit, eum minima ad nemo, cumque quos corrupti fugiat sequi numquam itaque natus inventore!\nDicta delectus inventore, quod a tempore temporibus odit, fuga id unde voluptates, consectetur perferendis natus amet architecto officiis distinctio! Inventore dignissimos quasi autem modi mollitia veniam a blanditiis corporis rem?\nNecessitatibus nihil numquam ad magni voluptatem labore quo, odit architecto quaerat adipisci eum quas neque enim sunt voluptate omnis quasi laudantium voluptates sed! Eos nihil aliquid exercitationem ut at modi!\nBeatae hic aliquid vitae vel aliquam repellendus velit cum aspernatur facilis accusamus accusantium obcaecati sint unde, enim debitis, totam quasi deserunt dolorum provident deleniti, quod dicta aperiam. Eaque, sequi ullam?\nAmet, in incidunt dolorem dolorum reprehenderit tenetur placeat nam neque hic obcaecati, distinctio blanditiis cumque quae repellat quidem veritatis quibusdam ex, rem beatae maxime nulla recusandae iusto perferendis harum. Asperiores!\nUllam deleniti ipsam quasi asperiores labore rerum, inventore voluptas molestiae corrupti porro illum animi, vero, iure soluta eveniet exercitationem aspernatur illo id reiciendis pariatur praesentium itaque minus nihil facere. Corporis?\nIllum odit cumque, commodi asperiores deleniti provident sapiente fugit et beatae minus tenetur voluptatibus dolores sint est nobis error culpa, soluta eius laboriosam vitae officiis, inventore mollitia? Unde, deserunt perferendis!\nIncidunt, sapiente obcaecati? Iusto voluptatibus atque saepe id aperiam ad at adipisci maxime recusandae dolores, eum quas commodi labore rem libero accusantium. Porro earum soluta explicabo voluptatibus vero tempore mollitia.\nUllam error deserunt officiis voluptatum magni fugiat culpa neque commodi sunt perspiciatis quisquam placeat quo corrupti beatae inventore doloremque, soluta quam adipisci corporis fugit accusantium dolor nam. Consectetur, tempora atque.\nAsperiores pariatur, architecto, cum aspernatur repudiandae quos natus accusamus eius libero consectetur laboriosam reiciendis? Enim, nemo dolores? Veniam ut deserunt fuga? Quaerat nostrum velit sint quibusdam voluptate modi dicta dignissimos.', '2022-12-03', 2, '0'),
(5, 'img/5.jpg', 'Blog Başlık 5', 'Blog İçerik 5 Lorem ipsum dolor sit, amet consectetur adipisicing elit. Velit cum exercitationem officiis doloremque maxime esse possimus odit, eum minima ad nemo, cumque quos corrupti fugiat sequi numquam itaque natus inventore!\nDicta delectus inventore, quod a tempore temporibus odit, fuga id unde voluptates, consectetur perferendis natus amet architecto officiis distinctio! Inventore dignissimos quasi autem modi mollitia veniam a blanditiis corporis rem?\nNecessitatibus nihil numquam ad magni voluptatem labore quo, odit architecto quaerat adipisci eum quas neque enim sunt voluptate omnis quasi laudantium voluptates sed! Eos nihil aliquid exercitationem ut at modi!\nBeatae hic aliquid vitae vel aliquam repellendus velit cum aspernatur facilis accusamus accusantium obcaecati sint unde, enim debitis, totam quasi deserunt dolorum provident deleniti, quod dicta aperiam. Eaque, sequi ullam?\nAmet, in incidunt dolorem dolorum reprehenderit tenetur placeat nam neque hic obcaecati, distinctio blanditiis cumque quae repellat quidem veritatis quibusdam ex, rem beatae maxime nulla recusandae iusto perferendis harum. Asperiores!\nUllam deleniti ipsam quasi asperiores labore rerum, inventore voluptas molestiae corrupti porro illum animi, vero, iure soluta eveniet exercitationem aspernatur illo id reiciendis pariatur praesentium itaque minus nihil facere. Corporis?\nIllum odit cumque, commodi asperiores deleniti provident sapiente fugit et beatae minus tenetur voluptatibus dolores sint est nobis error culpa, soluta eius laboriosam vitae officiis, inventore mollitia? Unde, deserunt perferendis!\nIncidunt, sapiente obcaecati? Iusto voluptatibus atque saepe id aperiam ad at adipisci maxime recusandae dolores, eum quas commodi labore rem libero accusantium. Porro earum soluta explicabo voluptatibus vero tempore mollitia.\nUllam error deserunt officiis voluptatum magni fugiat culpa neque commodi sunt perspiciatis quisquam placeat quo corrupti beatae inventore doloremque, soluta quam adipisci corporis fugit accusantium dolor nam. Consectetur, tempora atque.\nAsperiores pariatur, architecto, cum aspernatur repudiandae quos natus accusamus eius libero consectetur laboriosam reiciendis? Enim, nemo dolores? Veniam ut deserunt fuga? Quaerat nostrum velit sint quibusdam voluptate modi dicta dignissimos.', '2022-11-28', 2, '1'),
(6, 'img/6.jpg', 'Blog Başlık 6', 'Blog İçerik 6 admin Lorem ipsum dolor sit, amet consectetur adipisicing elit. Velit cum exercitationem officiis doloremque maxime esse possimus odit, eum minima ad nemo, cumque quos corrupti fugiat sequi numquam itaque natus inventore!\nDicta delectus inventore, quod a tempore temporibus odit, fuga id unde voluptates, consectetur perferendis natus amet architecto officiis distinctio! Inventore dignissimos quasi autem modi mollitia veniam a blanditiis corporis rem?\nNecessitatibus nihil numquam ad magni voluptatem labore quo, odit architecto quaerat adipisci eum quas neque enim sunt voluptate omnis quasi laudantium voluptates sed! Eos nihil aliquid exercitationem ut at modi!\nBeatae hic aliquid vitae vel aliquam repellendus velit cum aspernatur facilis accusamus accusantium obcaecati sint unde, enim debitis, totam quasi deserunt dolorum provident deleniti, quod dicta aperiam. Eaque, sequi ullam?\nAmet, in incidunt dolorem dolorum reprehenderit tenetur placeat nam neque hic obcaecati, distinctio blanditiis cumque quae repellat quidem veritatis quibusdam ex, rem beatae maxime nulla recusandae iusto perferendis harum. Asperiores!\nUllam deleniti ipsam quasi asperiores labore rerum, inventore voluptas molestiae corrupti porro illum animi, vero, iure soluta eveniet exercitationem aspernatur illo id reiciendis pariatur praesentium itaque minus nihil facere. Corporis?\nIllum odit cumque, commodi asperiores deleniti provident sapiente fugit et beatae minus tenetur voluptatibus dolores sint est nobis error culpa, soluta eius laboriosam vitae officiis, inventore mollitia? Unde, deserunt perferendis!\nIncidunt, sapiente obcaecati? Iusto voluptatibus atque saepe id aperiam ad at adipisci maxime recusandae dolores, eum quas commodi labore rem libero accusantium. Porro earum soluta explicabo voluptatibus vero tempore mollitia.\nUllam error deserunt officiis voluptatum magni fugiat culpa neque commodi sunt perspiciatis quisquam placeat quo corrupti beatae inventore doloremque, soluta quam adipisci corporis fugit accusantium dolor nam. Consectetur, tempora atque.\nAsperiores pariatur, architecto, cum aspernatur repudiandae quos natus accusamus eius libero consectetur laboriosam reiciendis? Enim, nemo dolores? Veniam ut deserunt fuga? Quaerat nostrum velit sint quibusdam voluptate modi dicta dignissimos.', '2022-12-02', 3, '0');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici`
--

DROP TABLE IF EXISTS `kullanici`;
CREATE TABLE IF NOT EXISTS `kullanici` (
  `id` tinyint NOT NULL AUTO_INCREMENT,
  `kullaniciAdi` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kullanici`
--

INSERT INTO `kullanici` (`id`, `kullaniciAdi`, `sifre`) VALUES
(1, 'sahra', '123');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `menuler`
--

DROP TABLE IF EXISTS `menuler`;
CREATE TABLE IF NOT EXISTS `menuler` (
  `id` int NOT NULL AUTO_INCREMENT,
  `menuAdi` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `menuLink` varchar(150) COLLATE utf8_turkish_ci NOT NULL,
  `resim` varchar(150) COLLATE utf8_turkish_ci NOT NULL,
  `aciklama` varchar(1000) COLLATE utf8_turkish_ci NOT NULL,
  `tarih` date NOT NULL,
  `ziyaret` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `menuler`
--

INSERT INTO `menuler` (`id`, `menuAdi`, `menuLink`, `resim`, `aciklama`, `tarih`, `ziyaret`) VALUES
(1, 'Blog', 'bloglar.php', 'img/m1.jpg', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Velit cum exercitationem officiis doloremque maxime esse possimus odit, eum minima ad nemo, cumque quos corrupti fugiat sequi numquam itaque natus inventore!\r\nDicta delectus inventore, quod a tempore temporibus odit, fuga id unde voluptates, consectetur perferendis natus amet architecto officiis distinctio! Inventore dignissimos quasi autem modi mollitia veniam a blanditiis corporis rem?\r\nNecessitatibus nihil numquam ad magni voluptatem labore quo, odit architecto quaerat adipisci eum quas neque enim sunt voluptate omnis quasi laudantium voluptates sed! Eos nihil aliquid exercitationem ut at modi!\r\nBeatae hic aliquid vitae vel aliquam repellendus velit cum aspernatur facilis accusamus accusantium obcaecati sint unde, enim debitis, totam quasi deserunt dolorum provident deleniti, quod dicta aperiam. Eaque, sequi ullam?\r\nAmet, in incidunt dolorem dolorum reprehenderit tenetur placeat nam neque hic obcaecati, distinctio blanditiis ', '2022-11-28', 2),
(35, 'Hakkımızda', 'hakkimizda.php', 'img/m2.jpg', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Velit cum exercitationem officiis doloremque maxime esse possimus odit, eum minima ad nemo, cumque quos corrupti fugiat sequi numquam itaque natus inventore!\r\nDicta delectus inventore, quod a tempore temporibus odit, fuga id unde voluptates, consectetur perferendis natus amet architecto officiis distinctio! Inventore dignissimos quasi autem modi mollitia veniam a blanditiis corporis rem?\r\nNecessitatibus nihil numquam ad magni voluptatem labore quo, odit architecto quaerat adipisci eum quas neque enim sunt voluptate omnis quasi laudantium voluptates sed! Eos nihil aliquid exercitationem ut at modi!\r\nBeatae hic aliquid vitae vel aliquam repellendus velit cum aspernatur facilis accusamus accusantium obcaecati sint unde, enim debitis, totam quasi deserunt dolorum provident deleniti, quod dicta aperiam. Eaque, sequi ullam?\r\nAmet, in incidunt dolorem dolorum reprehenderit tenetur placeat nam neque hic obcaecati, distinctio blanditiis ', '2022-12-01', 2),
(32, 'iletişim', 'iletisim.php', 'img/m3.jpg', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Velit cum exercitationem officiis doloremque maxime esse possimus odit, eum minima ad nemo, cumque quos corrupti fugiat sequi numquam itaque natus inventore!\r\nDicta delectus inventore, quod a tempore temporibus odit, fuga id unde voluptates, consectetur perferendis natus amet architecto officiis distinctio! Inventore dignissimos quasi autem modi mollitia veniam a blanditiis corporis rem?\r\nNecessitatibus nihil numquam ad magni voluptatem labore quo, odit architecto quaerat adipisci eum quas neque enim sunt voluptate omnis quasi laudantium voluptates sed! Eos nihil aliquid exercitationem ut at modi!\r\nBeatae hic aliquid vitae vel aliquam repellendus velit cum aspernatur facilis accusamus accusantium obcaecati sint unde, enim debitis, totam quasi deserunt dolorum provident deleniti, quod dicta aperiam. Eaque, sequi ullam?\r\nAmet, in incidunt dolorem dolorum reprehenderit tenetur placeat nam neque hic obcaecati, distinctio blanditiis ', '2022-12-02', 2),
(37, '  Admin', 'admin.php', 'img/m4.jpg', 'Admin Lorem ipsum dolor sit, amet consectetur adipisicing elit. Velit cum exercitationem officiis doloremque maxime esse possimus odit, eum minima ad nemo, cumque quos corrupti fugiat sequi numquam itaque natus inventore!\r\nDicta delectus inventore, quod a tempore temporibus odit, fuga id unde voluptates, consectetur perferendis natus amet architecto officiis distinctio! Inventore dignissimos quasi autem modi mollitia veniam a blanditiis corporis rem?\r\nNecessitatibus nihil numquam ad magni voluptatem labore quo, odit architecto quaerat adipisci eum quas neque enim sunt voluptate omnis quasi laudantium voluptates sed! Eos nihil aliquid exercitationem ut at modi!\r\nBeatae hic aliquid vitae vel aliquam repellendus velit cum aspernatur facilis accusamus accusantium obcaecati sint unde, enim debitis, totam quasi deserunt dolorum provident deleniti, quod dicta aperiam. Eaque, sequi ullam?\r\nAmet, in incidunt dolorem dolorum reprehenderit tenetur placeat nam neque hic obcaecati, distinctio bland', '2022-12-03', 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `todo`
--

DROP TABLE IF EXISTS `todo`;
CREATE TABLE IF NOT EXISTS `todo` (
  `id` tinyint NOT NULL AUTO_INCREMENT,
  `baslik` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `aciklama` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `tarih` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `todo`
--

INSERT INTO `todo` (`id`, `baslik`, `aciklama`, `tarih`) VALUES
(10, 'proje', '', '2022-11-29'),
(8, 'proje', 'Veritabanı bağlantı işlemleri', '2022-11-29'),
(9, 'proje', 'Template seçimi', '2022-11-28'),
(11, 'Güvenli Başlık', 'Güvenli Açıklama', '2022-11-30');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
