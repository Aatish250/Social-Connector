<?php
class Mutuals
{
    private $conn;
    private $uid;
    private $fof_ID;
    private $limit;
    private $all_mutuals = null;

    public function __construct($conn, $uid, $fof_ID, $limit = 3)
    {
        $this->conn = $conn;
        $this->uid = $uid;
        $this->fof_ID = $fof_ID;
        $this->limit = $limit;
    }

    public function getAllMutualIDs()
    {
        if ($this->all_mutuals === null) {
            $this->all_mutuals = getMutualsIDsFor($this->conn, $this->uid, $this->fof_ID);
            shuffle($this->all_mutuals);
        }
        return $this->all_mutuals;
    }

    public function mutualCount()
    {
        return count($this->getAllMutualIDs());
    }

    public function echoImage($limit = null)
    {
        $limit = $limit ?? $this->limit;
        $allMututals = $this->getAllMutualIDs();
        $total = count($allMututals);
        $limitedDisplay = array_slice($allMututals, 0, $limit);
        $remaningCount = $total - $limit;
        ?>
        <div class="flex items-center gap-2 mb-2">
            <div class="flex flex-row-reverse">
                <?php
                $mrgleft = ($total > 1) ? '-ml-3' : '';
                foreach ($limitedDisplay as $mUID) {
                    $mUser = getUserDetail($this->conn, $mUID);
                    // Border color set to same as background (bg-gray-200)
                    echo "<img src='" . htmlspecialchars($mUser['profile_pic']) . "' alt='Mutual' class='max-w-8 max-h-8 rounded-full shadow-sm bg-gray-200 object-cover border-2 border-surface-container $mrgleft' />";

                }
                ?>
            </div>
            <?php if ($total > $limit): ?>
                <span
                    class="text-xs text-on-surface-variant bg-surface-variant text-white rounded-full w-8 h-8 flex justify-center items-center -ml-4 opacity-65">
                    +
                    <?= $remaningCount ?>
                </span>
            <?php endif; ?>
        </div>
        <?php
    }

}