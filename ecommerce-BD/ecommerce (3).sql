-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-11-2026 a las 23:53:06
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ecommerce`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idCategoria` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idCategoria`, `nombre`) VALUES
(1, 'Ron'),
(2, 'Vodka'),
(3, 'Vino'),
(4, 'Whisky'),
(5, 'Sidra'),
(6, 'Ginebra'),
(7, 'Tequila'),
(8, 'Brandy'),
(9, 'Espumante'),
(10, 'Bebida sin alcohol');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE `items` (
  `idItem` int(11) NOT NULL,
  `idVenta` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `costo` decimal(10,2) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `marca` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `nombre`, `codigo`, `idCategoria`, `descripcion`, `costo`, `precio`, `foto`, `idProveedor`, `stock`, `marca`) VALUES
(1, 'Gran Reserva Malbec', 'VIN001', 3, 'Vino tinto con notas de frutos rojos y maduración de 12 meses en roble francés. Ideal para carnes rojas.\r\n', 4500.00, 8900.00, 'https://evatiendadevinos.com.ar/wp-content/uploads/2024/11/52_sur_de_los_andes_malbec_gran_reserva_2020.jpg', 2, 60, 'Sur de Los Andes'),
(2, 'Cabernet Sauvignon Intenso', 'VIN002', 3, 'Tinto robusto con aromas a pimienta negra y cassis. Cuerpo estructurado y final persistente.\r\n', 3800.00, 7500.00, 'https://www.lacavadeltosco.com.ar/wp-content/uploads/2025/05/lujan-conesa-cs.jpg', 4, 22, 'Familia Lujan Conesa'),
(3, 'Chardonnay Torrontes', 'VIN003', 3, 'Vino blanco aromático con notas de manzana verde, pera y un toque sutil de vainilla.', 3200.00, 6400.00, 'https://vinosnobles.com.ar/wp-content/uploads/2026/03/IMG_4880-scaled.webp', 3, 40, 'Domaine Bousquet'),
(4, 'Sauvignon Blanc Fresco', 'VIN004', 3, 'Blanco joven y ligero, con alta acidez cítrica y notas herbáceas. Perfecto para pescados.', 2900.00, 5800.00, 'https://www.bodegasalentein.com/imagenes/userfiles/images/IMG_5055.jpg', 1, 18, 'Salentein Reserva'),
(5, 'Rosé de Noir', 'VIN005', 9, 'Vino espumante rosado elegante a base de Pinot Noir. Notas de frutilla y flores silvestres\r\n', 3500.00, 7000.00, 'https://vinosnobles.com.ar/wp-content/uploads/2026/02/IMG_3665-scaled.webp', 2, 25, 'Maria'),
(6, 'Espumante Brut Nature', 'VIN006', 9, 'Burbujas finas y persistentes. Método tradicional con notas de pan tostado y frutos secos.', 5200.00, 10500.00, 'https://www.norton.com.ar/wp-content/uploads/2023/09/Brut-Nature.jpg', 3, 12, 'Norton'),
(7, 'Whisky Single Malt 12 Años', 'W001', 4, 'Whisky escocés con sutiles notas de humo de turba, miel silvestre y un final largo de roble tostado.', 15000.00, 28000.00, 'https://acdn-us.mitiendanube.com/stores/001/408/416/products/img_5806-ee5a360c8f1e6518bb17525351058619-1024-1024.webp', 5, 10, 'Glen Elgin'),
(8, 'Whisky Bourbon Oak', 'W002', 4, 'Destilado americano madurado en barricas de roble americano nuevo carbonizado. Notas dulces de vainilla y caramelo.', 9500.00, 18500.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRvVEtFcWxYFmYVfs8YRoAUv6jKZnXnE_gorW3ulojjxylCTnwkexSakkU&s=10', 4, 8, 'Noble Oak'),
(9, 'Vodka Premium Triple Destilado', 'V001', 2, 'Ultra puro y cristalino, filtrado en carbón de abedul. Ideal para coctelería fina o tomar bien frío.\r\n', 4200.00, 8400.00, 'https://http2.mlstatic.com/D_NQ_NP_812093-MLA46192980676_052021-O.webp', 5, 6, 'Eristoff'),
(10, 'Vodka Saborizado Citrus\r\n', 'V002', 2, 'Vodka suave infusionado con extractos naturales de limones y limas seleccionadas. Fresco y vibrante.', 3500.00, 6900.00, 'https://acdn-us.mitiendanube.com/stores/001/408/416/products/img_4515-48b6a14fb6d9ed922217470684433215-1024-1024.webp', 2, 11, 'Smirnoff'),
(11, 'Ron Añejo 8 Años', 'RON001', 1, 'Ron caribeño con un perfil rico y complejo de frutos secos, especias, canela y un fondo de melaza.', 6000.00, 11800.00, 'https://http2.mlstatic.com/D_NQ_NP_915454-MLA96326276633_102025-O.webp', 5, 20, 'Santiago de Cuba'),
(12, 'Ron Blanco Carta Plata', 'RON002', 1, 'Ligero, limpio y cristalino. El compañero perfecto para armar los mejores Mojitos y Daiquiris.	\r\n', 3800.00, 7500.00, 'https://http2.mlstatic.com/D_NQ_NP_674803-MLA108740280296_032026-O.webp', 3, 15, 'Bacardi'),
(13, 'Sidra Artesanal Seca', 'SID001', 5, 'Elaborada con manzanas seleccionadas mediante fermentación tradicional. Burbuja natural y acidez equilibrada.', 2200.00, 4500.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTPHPJfY0vLkmH3g0aB8kls0syKtxXX9D9zo4rzBOSxVhSiuBQvQfV78aU&s=10', 2, 28, 'Pehuenia'),
(14, 'Sidra de Manzana Sweet', 'SID002', 5, '\r\n	Opción dulce y refrescante, ideal para celebraciones o para acompañar postres frutales.\r\n', 1900.00, 3900.00, 'https://http2.mlstatic.com/D_NQ_NP_996944-MLA82403858741_022025-O.webp', 2, 30, 'Pehuenia'),
(15, 'Ginebra Clásica Premium', 'GIN001', 6, 'Estilo clásico con fuerte presencia de bayas de enebro, combinada con sutiles notas de piel de naranja.', 5500.00, 10900.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRn7NtMZOnrAVcgTwMRdcCEaWJMI1rsU23bXsFrsYCbAkjG4xT3hoFV2coV&s=10', 4, 21, 'ShortCross'),
(16, 'Ginebra Rosa de Arándanos', 'GIN002', 6, 'Destilado contemporáneo infusionado con arándanos y pétalos de rosa que le dan un tono rosa y aroma floral.', 5800.00, 11500.00, 'https://i0.wp.com/elplanetaurbano.com/wp-content/uploads/2022/04/Terrier-Pink.jpg?resize=640%2C804&ssl=1', 5, 18, 'Terrier'),
(17, 'Tequila Reposado 100% Agave', 'TEQ001', 7, 'Envejecido en barricas de roble durante 6 meses. Equilibrio perfecto entre el agave cocido y la madera.', 11000.00, 21500.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQK2onWF7z3KKHImXcLsk8sRxSI-Qzot_t8n_CDYQWr8g&s', 4, 21, 'Herradura'),
(18, 'Tequila Blanco Plata\r\n', 'TEQ002', 7, 'Tequila joven, directo y con el sabor puro y herbáceo del agave azul. Notas cítricas muy marcadas.', 8500.00, 16500.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTsRVUROZWZyxQu5FNHxA8KRxeMbXbxOljs_GVL7T0vXQ&s=10', 4, 20, 'Herradura'),
(19, 'Brandy Gran Reserva', 'BRA001', 8, 'Destilado de vino premium envejecido en barricas de roble francés. Notas de ciruelas pasas, vainilla y nueces.\r\n', 12500.00, 24000.00, 'https://encrypted-tbn0.gstatic.com/shopping?q=tbn:ANd9GcQt0WbvMH9eEyaINQz7R47TLuyzImtgpeVRHxx7OHQMty_wnl_Tan_uLD-H_bjfU4hlxVV_XFWvPYBKYmLk1zZRdKv89lybeANJIWTcgbY', 5, 31, 'Bardinet'),
(20, 'Brandy Solera Viejo', 'BRA002', 8, 'Suave, espirituoso y equilibrado, elaborado bajo el método tradicional de soleras. Ideal para la sobremesa.\r\n', 7000.00, 13900.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAnRZ3xADlZNdtihcfSbhPk9JhJIDES7rF5pxWBkKTpw&s', 1, 19, 'Soberano'),
(21, 'Gin Tonic Sin Alcohol', 'SIN001', 10, 'Todo el sabor botánico y refrescante del Gin Tonic tradicional, pero con 0% de graduación alcohólica.', 2800.00, 5500.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQgWNxI_z-V1g2Vk4e3yDbXuarNSZQS9ekFYNh76CNGnQ&s', 4, 25, 'Le Mat'),
(22, 'Vino Tinto Desalcoholizado', 'SIN002', 10, 'Un delicioso blend tinto que conserva los antioxidantes y aromas frutales del vino, sin rastro de alcohol.', 3200.00, 6400.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQpPyEhko7iqnARSvaDfFVM44yV6g2fizdFHlw_5SkpMQ&s=10', 5, 14, 'Buen Finde');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `idProveedor` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `cuit` varchar(11) NOT NULL,
  `razonSocial` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`idProveedor`, `nombre`, `cuit`, `razonSocial`) VALUES
(1, 'Distribuidora Carmen', '00000000001', 'Ditribuidora Carmen S.R.L.'),
(2, 'Beco Distribuciones', '00000000002', 'Beco S.A.'),
(3, 'Distribuidora Gold', '00000000003', 'Gold S.A.'),
(4, 'Promark Distribuciones', '00000000004', 'Promark S.R.L'),
(5, 'Maxiconsumo', '00000000005', 'Maxiconsumo S.R.L.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `rol` varchar(50) NOT NULL DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombre`, `password`, `email`, `rol`) VALUES
(2, 'Administrador', '$2y$10$Zm.YDnMWR7T09mK4ZRbdK.21J1VPxm9e.mVCuMuWCtamSeesns6Dm', 'admin@ecommerce.com', 'admin'),
(3, 'Maximiliano Diaz', '$2y$10$LNfEBFEhqEbZ/gksFXvrb.7jmwLYjy.3hAo8tDfaKbcXtt2UXRsbe', 'maxidiazelcapo@gmail.com', 'cliente'),
(4, 'Maximiliano Diaz', '$2y$10$dEkuwcJjXfaQCCQX49pVyun65zucAOjkjyFAJ2j53oUDh2yPXv2ZO', 'maxidiazelcapo@hotmail.com', 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `idVenta` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `estadoPago` char(1) NOT NULL,
  `estadoEnvio` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`idItem`),
  ADD KEY `idVenta` (`idVenta`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `idCategoria` (`idCategoria`),
  ADD KEY `idProveedor` (`idProveedor`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`idProveedor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`idVenta`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `items`
--
ALTER TABLE `items`
  MODIFY `idItem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `idVenta` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
