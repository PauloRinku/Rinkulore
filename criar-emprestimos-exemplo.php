<?php
include 'config.php';

header('Content-Type: application/json');

try {
    // Limpar empréstimos existentes (opcional)
    // $conn->query("DELETE FROM Emprestimos");
    
    // Inserir empréstimos de exemplo
    $emprestimos = [
        [1, 1, '2024-01-15', '2024-01-29', '2024-01-28'],
        [2, 3, '2024-02-01', '2024-02-15', NULL],
        [3, 5, '2024-02-10', '2024-02-24', '2024-02-23'],
        [4, 2, '2024-03-05', '2024-03-19', '2024-03-18'],
        [5, 7, '2024-03-15', '2024-03-29', NULL],
        [6, 9, '2024-04-01', '2024-04-15', '2024-04-14'],
        [7, 4, '2024-04-10', '2024-04-24', '2024-04-24'],
        [8, 6, '2024-05-01', '2024-05-15', '2024-05-14'],
        [9, 8, '2024-05-10', '2024-05-24', NULL],
        [10, 10, '2024-05-20', '2024-06-03', '2024-06-02']
    ];
    
    $stmt = $conn->prepare("INSERT INTO Emprestimos (fk_id_livro, fk_id_membro, data_emprestimo, data_devolucao_prevista, data_devolucao_real) VALUES (?, ?, ?, ?, ?)");
    
    $inseridos = 0;
    foreach ($emprestimos as $emp) {
        $stmt->bind_param("iisss", $emp[0], $emp[1], $emp[2], $emp[3], $emp[4]);
        if ($stmt->execute()) {
            $inseridos++;
        }
    }
    
    echo json_encode([
        "success" => true,
        "message" => "{$inseridos} empréstimos de exemplo criados com sucesso!",
        "total" => $inseridos
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "error" => $e->getMessage()
    ]);
}

$conn->close();
?>