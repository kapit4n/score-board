
// update score goals
delimiter ///
CREATE TRIGGER total_sum BEFORE INSERT ON score
FOR EACH ROW
BEGIN
UPDATE team SET total = total + NEW.score_value WHERE id=NEW.team_id;
END;
///



alter table team add total_goals INT NOT NULL; ///
// update championship goals

delimiter ///
CREATE TRIGGER total_goals BEFORE INSERT ON team_match
FOR EACH ROW
BEGIN
UPDATE team SET total_goals = total_goals + NEW.visitor_score WHERE id=NEW.visitor_team;
UPDATE team SET total_goals = total_goals + NEW.local_score WHERE id=NEW.local_team;
END;
///


alter table team add total_points INT NOT NULL; ///

// update championship points
CREATE TRIGGER total_scores BEFORE INSERT ON team_match
FOR EACH ROW
BEGIN
UPDATE team SET total_points = total_points + 3 WHERE id=NEW.visitor_team AND NEW.visitor_score > NEW.local_score;
UPDATE team SET total_points = total_points + 3 WHERE id=NEW.local_team AND NEW.visitor_score < NEW.local_score;

UPDATE team SET total_points = total_points + 1 WHERE id=NEW.visitor_team AND NEW.visitor_score = NEW.local_score;
UPDATE team SET total_points = total_points + 1 WHERE id=NEW.local_team AND NEW.visitor_score = NEW.local_score;

UPDATE team SET total_goals = total_goals + NEW.visitor_score WHERE id=NEW.visitor_team;
UPDATE team SET total_goals = total_goals + NEW.local_score WHERE id=NEW.local_team;

END;
///

