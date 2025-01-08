use ravi;
CREATE TABLE user (
    id INT AUTO_INCREMENT,
    fullname VARCHAR(100),
    username VARCHAR(255),
    password VARCHAR(200),
    reg_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    activation_code varchar(50),
    plans VARCHAR(30) DEFAULT 'free',
    storage FLOAT DEFAULT 10,
    used_storage FLOAT DEFAULT 0,
    status varchar(11) DEFAULT "pending",
    PRIMARY KEY (id)
);
