
<?php include ROOT . '/views/layouts/header.php'; ?>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <h1 style="margin-top: 50px;"> Добавление задачи </h1>

		<form action="/new/submit/" method="post" name="new">
			<div class="tab-content">
				<div class="tab-pane active" role="tabpanel">

					<div class="form-group">
						<label>Имя пользователя</label>
						<input class="form-control" type="text" id="name" name="name"
						       required="required" placeholder="Александр">
					</div>

					<div class="form-group">
						<label>E-Mail</label>
						<input type="email" class="form-control" placeholder="alex@mail.ru"
                               id="email" name="email" required data-validation-required-message="Пожалуйста, введите Ваш email.">
					</div>


					<div class="form-group">
						<label>Текст задачи</label>
						<input class="form-control" type="text" id="text" name="text" placeholder="Текст"
						       required="required">
					</div>

					<div class="form-group">
						<label>Статус</label>
						<input class="form-control" type="text" id="state" name="state" value=""
						       required="required">
					</div>
						
					<div class="d-flex justify-content-end">
						<button type="submit" class="btn btn-info">Сохранить 
						</button>
					</div>
				</div>
			</div>
		</form>
        
    </div>
</div>

<hr>

<?php include ROOT . '/views/layouts/footer.php'; ?>