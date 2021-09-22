/** 
*		Name: David Luong		HW#8
*/


-- Question #1
SELECT statecode FROM employer
UNION
SELECT location FROM quarter;


-- Question #2
SELECT DISTINCT employer.companyname, interview.division, employer.statecode, interview.salaryoffered
FROM interview JOIN employer                  		      
ON interview.companyname = employer.companyname;


-- Question #3
SELECT *
FROM state
WHERE statecode NOT IN (
	SELECT statecode
	FROM employer
);


-- Question #4
SELECT DISTINCT companyname, minhrsoffered
FROM interview;


-- Question #5
SELECT *
FROM state 
WHERE description LIKE '__a%' OR
description LIKE '__e%' OR
description LIKE '__i%' OR
description LIKE '__o%' OR
description LIKE '__u%';


-- Question #6
SELECT DISTINCT quarter.qtrcode, quarter.location, state.description
FROM quarter INNER JOIN state
ON quarter.location = state.statecode;


-- Question #7
SELECT state.description, employer.companyname
FROM state LEFT OUTER JOIN employer
ON employer.statecode = state.statecode;

