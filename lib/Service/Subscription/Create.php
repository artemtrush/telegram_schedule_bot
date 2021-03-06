<?php

namespace Service\Subscription;

class Create extends \Service\Base
{
    public function execute(array $params)
    {
        if (!$this->pdo()) {
            return $this->error();
        }

        $user = $this->getUser($params['chatID']);
        if (empty($user['groupID'])) {
            return $this->userGroupNotFoundError();
        }
//@TODOT
        $this->setUserSubsTime($params['chatID'], $params['subTime']);
        return '';
    }

    private function setUserSubsTime(int $chatID, string $subTime) {
        $query = "
            UPDATE `users`
            SET `subTime` = :subTime
            WHERE `chatID` = :chatID
        ";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':subTime', $subTime, \PDO::PARAM_STR);
        $stmt->bindParam(':chatID',  $chatID,  \PDO::PARAM_INT);
        $stmt->execute();
    }
}
