
select total from team;

alter table team add total INT NOT NULL; ///


insert into team(name) values ('Aurora');


create table score(score_id INT NOT NULL AUTO_INCREMENT, score_value INT(4) NOT NULL, team_id INT(6) UNSIGNED NOT NULL,  PRIMARY KEY (score_id), FOREIGN KEY (team_id) REFERENCES team(id));
Query OK, 0 rows affected (0.05 sec)

mysql> delimiter ///
mysql> CREATE TRIGGER total_sum BEFORE INSERT ON score
    -> FOR EACH ROW
    -> BEGIN
    -> UPDATE team SET total = total + NEW.score_value WHERE id=NEW.team_id;
    -> END;
    -> ///


