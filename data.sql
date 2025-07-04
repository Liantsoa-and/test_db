use employees;

/* ok */
create or replace view v_employees_dept as
select d.*,e.*,de.from_date,de.to_date 
from employees as e join dept_emp as de
on e.emp_no = de.emp_no join departments as d 
on d.dept_no = de.dept_no;

/* ok */
create or replace view v_employees_dept_current as
select * from v_employees_dept where to_date='9999-01-01';

/* ok */
create or replace view v_manager_dept as
select d.*,e.*,de.from_date,de.to_date 
from employees as e join dept_manager as de
on e.emp_no=de.emp_no join departments as d 
on d.dept_no=de.dept_no;

/* ok */
create or replace view v_manager_dept_current as
select * from v_manager_dept where to_date='9999-01-01';


/* ok */
create or replace view v_employees_title as
select e.*,t.title,t.from_date,t.to_date 
from employees as e join titles as t
on e.emp_no=t.emp_no;

/* ok */
create or replace view v_employees_title_current as
select * from v_employees_title where to_date='9999-01-01';

/* ok */
create or replace view v_employees_salarie as
select e.*,sa.salary,sa.from_date,sa.to_date 
from employees as e join salaries as sa
on e.emp_no=sa.emp_no ;

/* ok */
create or replace view v_employees_salarie_current as
select * from v_employees_salarie where to_date='9999-01-01';

/* ok */
create or replace view v_employees_age as
select e.first_name, timestampdiff(year, e.birth_date, now()) as age, dept.dept_name from employees as e
join dept_emp as d
on e.emp_no = d.emp_no
join departments as dept
on d.dept_no = dept.dept_no
where d.to_date = '9999-01-01';

/* ok */
create or replace view v_employee_job_duration as 
select e.*, t.title, t.from_date, t.to_date, 
timestampdiff(year, t.from_date, if(t.to_date = '9999-01-01', now(), t.to_date)) AS duration
from employees e
join titles t on e.emp_no = t.emp_no;

/* non - view */
select max(duration) from v_employee_job_duration;

create or replace view v_employees_dept_femmme as
select * from v_employees_dept_current where gender = "F";

create or replace view v_employees_dept_homme as
select * from v_employees_dept_current where gender = "M";