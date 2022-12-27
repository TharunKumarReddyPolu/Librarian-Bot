<style>
* {
  font-family: sans-serif; /* Change your font family */
}

.content-table {
  border-collapse: collapse;
  margin: 250px 10%;
  font-size: 1em;
  border-radius: 15px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
  width:85%;
  }

.content-table thead tr {
  background-color: #12192C;
  color: #ffffff;
  text-align: left;
  font-weight: bold;
  padding:40px 10px;
}
.content-table tbody tr:hover {
  background-color: #f3f3f3;
  color: #000000;
  text-align: left;
  padding:40px 10px;
}
.content-table thead tr th:first-of-type{
	width:60px;
}
.content-table thead tr th:last-of-type{
	width:100px;
}
.content-table thead tr th{
	padding:15px 15px 10px 10px;
}
.one{
	width:100px;
}
.two{
	width:80px;
}
.content-table th,
.content-table td {
  padding: 10px 10px;
}

.content-table tbody tr {
  border-bottom: 1px solid #dddddd;
}

.content-table tbody tr:nth-of-type(even) {
  background-color: #f3f3f3;
}

.content-table tbody tr:last-of-type {
  border-bottom: 2px solid #12192C;
}

.content-table tbody tr.active-row {
  font-weight: bold;
  color: #12192C;
}

.button {
  border-radius: 7px;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 15px;
  padding: 10px 10px;
  width: 50px;
  transition: all 0.5s;
  cursor: pointer;
  margin-right: 0px;
  margin-left:0px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}
	.button1 {
    background-color: #0C5DF4;
    }
	.button2 {
    background-color: #FF1212;
    }
	.button3 {
		background-color: #ffd500;
		color:#000000;
    }
</style>




<html>
<table class="content-table">
  <thead>
    <tr>
      <th>Rank</th>
      <th>Book</th>
      <th>Custody</th>'
      <th>Date of lent</th>
      <th class="two">Update</th>
      <th class="two">View</th>
      <th class="one">Delete</th>
    </tr>
  </thead>
  <tbody>

    <tr>
      <td>1</td>
      <td>Domenic</td>
      <td>88,110</td>
      <td>88,110</td>
      <td><button class="button button1"><ion-icon name="arrow-up-circle" class="nav__icon"></button></td>
      <td><button class="button button3"><ion-icon name="eye" class="nav__icon"></ion-icon></button></td>
      <td><button class="button button2"><ion-icon name="trash-bin" class="nav__icon"></ion-icon></button></td>
    </tr>

    <tr class="active-row">
      <td>2</td>
      <td>Sally</td>
      <td>72,400</td>
	    <td>88,110</td>
      <td><button class="button button1"><ion-icon name="arrow-up-circle" class="nav__icon"></button></td>
	    <td><button class="button button3"><ion-icon name="eye" class="nav__icon"></button></td>
      <td><button class="button button2"><ion-icon name="trash-bin" class="nav__icon"></button></td>
    </tr>

    <tr>
      <td>3</td>
      <td>Nick</td>
      <td>52,300</td>
	    <td>88,110</td>
      <td><button class="button button1"><ion-icon name="arrow-up-circle" class="nav__icon"></button></td>
	    <td><button class="button button3"><ion-icon name="eye" class="nav__icon"></button></td>
	    <td><button class="button button2"><ion-icon name="trash-bin" class="nav__icon"></button></td>
    </tr>

  </tbody>
</table>
</html>
<script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>