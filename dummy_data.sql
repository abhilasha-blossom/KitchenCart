INSERT INTO users (name, email, password, role, status) VALUES ('System Admin', 'admin@kitchencart.com', 'admin123', 'admin', 1);
INSERT INTO users (name, email, password, role, status) VALUES ('Fresh Farms Co.', 'vendor@kitchencart.com', 'vendor123', 'vendor', 1);
INSERT INTO users (name, email, password, role, status) VALUES ('The Local Diner', 'restaurant@kitchencart.com', 'resto123', 'restaurant', 1);

INSERT INTO vendors (user_id, vendor_name, verified, reliability_score) VALUES ((SELECT user_id FROM users WHERE email='vendor@kitchencart.com'), 'Fresh Farms Wholesale', 1, 98.5);
