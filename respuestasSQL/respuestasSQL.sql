
-- a). Crea una sentencia SQL para listar todos los clientes que pagaron su cotización.
SELECT DISTINCT c.* FROM clientes c JOIN cotizaciones cz ON c.cliente_id = cz.cliente_id WHERE cz.estatus = 'Pagado';

-- b). Crea una sentencia SQL para listar todos los clientes con cotizaciones pendientes por pagar del mes de febrero 2025.
SELECT DISTINCT c.* FROM clientes c JOIN cotizaciones cz ON c.cliente_id = cz.cliente_id WHERE cz.estatus = 'Pendiente' AND MONTH(cz.fecha_cotizacion) = 2 AND YEAR(cz.fecha_cotizacion) = 2025;

-- c). Obtener todas las co7zaciones que contengan al menos un producto cuyo stock sea mayor a 20.
SELECT DISTINCT cz.* FROM cotizaciones cz JOIN detalle_cotizacion dc ON cz.cotizacion_id = dc.cotizacion_id JOIN productos p ON dc.producto_id = p.producto_id WHERE p.stock > 20;

-- d). Listar los proveedores que suministran productos con un precio superior a 100.
SELECT DISTINCT pr.* FROM proveedores pr JOIN productos p ON pr.proveedor_id = p.proveedor_id WHERE p.precio > 100;

-- e). Obtener el total de ventas por producto en cada co7zación pagada.
SELECT cz.cotizacion_id, p.nombre AS producto, SUM(dc.precio_unitario) AS total_venta FROM cotizaciones cz JOIN detalle_cotizacion dc ON cz.cotizacion_id = dc.cotizacion_id JOIN productos p ON dc.producto_id = p.producto_id WHERE cz.estatus = 'Pagado' GROUP BY cz.cotizacion_id, p.nombre;

-- f). Obtener las ventas mensuales correspondientes al año 2024.
SELECT MONTH(fecha_cotizacion) AS mes, SUM(total_cotizado) AS total_ventas FROM cotizaciones WHERE YEAR(fecha_cotizacion) = 2024 AND estatus = 'Pagado' GROUP BY MONTH(fecha_cotizacion);

-- g). Contar el número de cotizaciones realizadas por cada cliente del proveedor “Concretos SA de CV” durante el 2024.
SELECT c.nombre AS cliente, COUNT(*) AS total_cotizaciones FROM cotizaciones cz JOIN clientes c ON cz.cliente_id = c.cliente_id JOIN proveedores p ON cz.proveedor_id = p.proveedor_id WHERE p.nombre = 'Concretos SA de CV' AND YEAR(cz.fecha_cotizacion) = 2024 GROUP BY c.cliente_id;

-- h). Obtener el total de ventas realizadas a cada proveedor en los meses de enero y febrero del 2025.
SELECT p.nombre AS proveedor, SUM(cz.total_cotizado) AS total_ventas FROM cotizaciones cz JOIN proveedores p ON cz.proveedor_id = p.proveedor_id WHERE YEAR(cz.fecha_cotizacion) = 2025 AND MONTH(cz.fecha_cotizacion) IN (1, 2) AND cz.estatus = 'Pagado' GROUP BY p.proveedor_id;

-- i). Obtener el cliente que más en cotizaciones a pagado en el último mes y muestra a que proveedor pertenece.
SELECT c.nombre AS cliente, p.nombre AS proveedor, SUM(cz.total_cotizado) AS total_pagado FROM cotizaciones cz JOIN clientes c ON cz.cliente_id = c.cliente_id JOIN proveedores p ON cz.proveedor_id = p.proveedor_id WHERE cz.estatus = 'Pagado' AND MONTH(cz.fecha_cotizacion) = MONTH(CURDATE()) - 1 AND YEAR(cz.fecha_cotizacion) = YEAR(CURDATE()) GROUP BY c.cliente_id, p.proveedor_id ORDER BY total_pagado DESC LIMIT 1;

-- j). Genera un listado de proveedores que contenga el total de cotizaciones pagadas y el monto total vendido.
SELECT p.nombre, COUNT(cz.cotizacion_id) AS total_cotizaciones, SUM(cz.total_cotizado) AS total_vendido FROM cotizaciones cz JOIN proveedores p ON cz.proveedor_id = p.proveedor_id WHERE cz.estatus = 'Pagado' GROUP BY p.proveedor_id;

-- k). Obtener el proveedor que ha realizado la mayor cantidad de ventas en el mes de enero 2025.
SELECT p.nombre, COUNT(*) AS total_ventas FROM cotizaciones cz JOIN proveedores p ON cz.proveedor_id = p.proveedor_id WHERE cz.estatus = 'Pagado' AND MONTH(cz.fecha_cotizacion) = 1 AND YEAR(cz.fecha_cotizacion) = 2025 GROUP BY p.proveedor_id ORDER BY total_ventas DESC LIMIT 1;

-- l). Generar la información del mes con mayor número de ventas durante el 2024.
SELECT MONTH(fecha_cotizacion) AS mes, COUNT(*) AS ventas_realizadas FROM cotizaciones WHERE YEAR(fecha_cotizacion) = 2024 AND estatus = 'Pagado' GROUP BY MONTH(fecha_cotizacion) ORDER BY ventas_realizadas DESC LIMIT 1;

-- m). Genera la información del mes con menor número de ventas.
SELECT MONTH(fecha_cotizacion) AS mes, COUNT(*) AS ventas_realizadas FROM cotizaciones WHERE estatus = 'Pagado' GROUP BY MONTH(fecha_cotizacion) ORDER BY ventas_realizadas ASC LIMIT 1;

-- n). Genera la información del producto más cotizado por mes durante el 2024.
SELECT mes, producto, total FROM ( SELECT MONTH(cz.fecha_cotizacion) AS mes, p.nombre AS producto, COUNT(*) AS total, RANK() OVER (PARTITION BY MONTH(cz.fecha_cotizacion) ORDER BY COUNT(*) DESC) AS rnk FROM detalle_cotizacion dc JOIN cotizaciones cz ON dc.cotizacion_id = cz.cotizacion_id JOIN productos p ON dc.producto_id = p.producto_id WHERE YEAR(cz.fecha_cotizacion) = 2024 GROUP BY mes, producto ) AS ranked WHERE rnk = 1;

-- r). Genera la información del cliente con mayor compras mes a mes durante el 2024.
SELECT mes, cliente_id, nombre, total FROM ( SELECT MONTH(cz.fecha_cotizacion) AS mes, c.cliente_id, c.nombre, SUM(cz.total_cotizado) AS total, RANK() OVER (PARTITION BY MONTH(cz.fecha_cotizacion) ORDER BY SUM(cz.total_cotizado) DESC) AS rk FROM cotizaciones cz JOIN clientes c ON cz.cliente_id = c.cliente_id WHERE YEAR(cz.fecha_cotizacion) = 2024 AND cz.estatus = 'Pagado' GROUP BY mes, c.cliente_id ) t WHERE rk = 1;

-- o). Lista a los proveedores con menor venta mes a mes durante el 2024.
SELECT mes, proveedor_id, nombre, total FROM ( SELECT MONTH(cz.fecha_cotizacion) AS mes, p.proveedor_id, p.nombre, SUM(cz.total_cotizado) AS total, RANK() OVER (PARTITION BY MONTH(cz.fecha_cotizacion) ORDER BY SUM(cz.total_cotizado)) AS rk FROM cotizaciones cz JOIN proveedores p ON cz.proveedor_id = p.proveedor_id WHERE YEAR(cz.fecha_cotizacion) = 2024 AND cz.estatus = 'Pagado' GROUP BY mes, p.proveedor_id ) t WHERE rk = 1;