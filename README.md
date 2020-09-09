

## Payroll System

Run Laravel project locally:

- Download Composer([https://getcomposer.org/download/]).
- Rename .env.example file to .env inside your project root and fill the database information.
- Open the console and cd your project root directory
- Run composer install or php composer.phar
- Run php artisan key:generate
- Run php artisan migrate
- Run php artisan db:seed
- Run php artisan serve


## Project Description

- we are prototyping a new payroll system API. A front end (that hasn't been developed yet, but will likely be
 a single page application) is going to use our API to achieve two goals:
  
  Upload a CSV file containing data on the number of hours worked per day per employee
  Retrieve a report detailing how much each employee should be paid in each pay period


All employees are paid by the hour (there are no salaried employees.) Employees belong to one of two job groups which determine their wages; job group A is paid $20/hr, and job group B is paid $30/hr. Each employee is identified by a string called an "employee id" that is globally unique in our system.

Hours are tracked per employee, per day in comma-separated value files (CSV). Each individual CSV file is known as a "time report", and will contain:

A header, denoting the columns in the sheet (date, hours worked, employee id, job group)
0 or more data rows
In addition, the file name should be of the format time-report-x.csv, where x is the ID of the time report represented as an integer. For example, time-report-42.csv would represent a report with an ID of 42.

You can assume that:

- Columns will always be in that order.
- There will always be data in each column and the number of hours worked will always be greater than 0.
- There will always be a well-formed header line.
- There will always be a well-formed file name.
- A sample input file named time-report-42.csv is included in this repo.

What your API must do:
We've agreed to build an API with the following endpoints to serve HTTP requests:

- An endpoint for uploading a file.

- This file will conform to the CSV specifications outlined in the previous section.
- Upon upload, the timekeeping information within the file must be stored to a database for archival purposes.
- If an attempt is made to upload a file with the same report ID as a previously uploaded file, this upload should fail with an error message indicating that this is not allowed.
- An endpoint for retrieving a payroll report structured in the following way:

NOTE: It is not the responsibility of the API to return HTML, as we will delegate the visual layout and redering to the front end. The expectation is that this API will only return JSON data.

- Return a JSON object payrollReport.
- payrollReport will have a single field, employeeReports, containing a list of objects with fields employeeId, payPeriod, and amountPaid.
- The payPeriod field is an object containing a date interval that is roughly biweekly. Each month has two pay periods; the first half is from the 1st to the 15th inclusive, and the second half is from the 16th to the end of the month, inclusive. payPeriod will have two fields to represent this interval: startDate and endDate.
- Each employee should have a single object in employeeReports for each pay period that they have recorded hours worked. The amountPaid field should contain the sum of the hours worked in that pay period multiplied by the hourly rate for their job group.
- If an employee was not paid in a specific pay period, there should not be an object in employeeReports for that employee + pay period combination.
- The report should be sorted in some sensical order (e.g. sorted by employee id and then pay period start.)
- The report should be based on all of the data across all of the uploaded time reports, for all time.

- A request to the report endpoint should return the following JSON response:

{
  payrollReport: {
    employeeReports: [
      {
        employeeId: 1,
        payPeriod: {
          startDate: "2020-01-01",
          endDate: "2020-01-15"
        },
        amountPaid: "$300.00"
      },
      {
        employeeId: 1,
        payPeriod: {
          startDate: "2020-01-16",
          endDate: "2020-01-31"
        },
        amountPaid: "$80.00"
      },
      {
        employeeId: 2,
        payPeriod: {
          startDate: "2020-01-16",
          endDate: "2020-01-31"
        },
        amountPaid: "$90.00"
      }
    ];
  }
}
