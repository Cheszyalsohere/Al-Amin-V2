<?php

test('registration route tidak tersedia', function () {
    $this->get('/register')->assertNotFound();
    $this->post('/register', [])->assertNotFound();
});
