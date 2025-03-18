<?php

namespace App\Http\Repository;

interface BookInterface
{
    public function all(string $payload);
    public function create(array $data);
    public function update(array $data, $id);
    public function delete($id);
    public function show($id);

    public function createBooking(int $bookId, int $userId);
    public function deleteBooking(int $bookId, int $userId);
}