create or replace view v_employees_age as
select e.first_name, timestampdiff(year, e.birth_date, now()) as age, dept.dept_name from employees as e
join dept_emp as d
on e.emp_no = d.emp_no
join departments as dept
on d.dept_no = dept.dept_no
where d.to_date = '9999-01-01';