CREATE TABLE team_match (
    match_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(25),
    visitor_score INT(4) NOT NULL, 
    local_score INT(4) NOT NULL, 
    visitor_team INT(6) UNSIGNED NOT NULL,
    local_team INT(6) UNSIGNED NOT NULL,
    FOREIGN KEY (visitor_team) REFERENCES team(id),
    FOREIGN KEY (local_team) REFERENCES team(id)
);
