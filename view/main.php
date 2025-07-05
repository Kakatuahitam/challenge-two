<main>
  <?php
    require_once 'model/RedisClient.php';
    require 'model/sessions.php';

    require_once 'controller/getSession.php';
    require_once 'controller/addSession.php';

    $get_service = new GetSessionService();
    $sessions = $get_service->getSessions();
  ?>

  <h3>Add Session</h3>

  <form method="POST" action='controller/addSession.php'>
    <table>
      <tr>
        <td>
          <p>Username: <input type="text" name="username"></p>
        </td>

        <td>
          <p>Exam Mode:
            <select name="exam_mode">
              <option value="01_IPA">IPA Kelas 1</option>
              <option value="02_IPA">IPA Kelas 2</option>
              <option value="03_IPA">IPA Kelas 3</option>
              <option value="04_IPA">IPA Kelas 4</option>
              <option value="05_IPA">IPA Kelas 5</option>
              <option value="06_IPA">IPA Kelas 6</option>
            </select>
          </p>
        </td>

        <td>
          <p><input type="submit" value="Generate"></p>
        </td>
      </tr>
    </table>
  </form>

  <h3>Edit Session</h3>
  <form method="POST" action="controller/updateSession.php">
    <table>
      <tr>
        <td>
          <p>Username (as ID): <input type="text" name="username" required></p>
        </td>
        <td>
          <p>New Exam Mode:
            <select name="exam_mode" required>
              <option value="01_IPA">IPA Kelas 1</option>
              <option value="02_IPA">IPA Kelas 2</option>
              <option value="03_IPA">IPA Kelas 3</option>
              <option value="04_IPA">IPA Kelas 4</option>
              <option value="05_IPA">IPA Kelas 5</option>
              <option value="06_IPA">IPA Kelas 6</option>
            </select>
          </p>
        </td>
        <td>
          <p><input type="submit" value="Update"></p>
        </td>
      </tr>
    </table>
  </form>

  <h3>Sessions</h3>

  <p>Click the record to delete (yes, without confirmation first, but in production, never!)<p>
  <ul>
    <?php foreach ($sessions as $s): ?>
      <li
        style="cursor:pointer; color:blue; text-decoration:underline;"
        onclick="window.location.href = 'controller/deleteSession.php?id=<?php echo urlencode($s['id']); ?>';"
      >
        <?php echo htmlspecialchars($s['username']); ?>
        (Exam Mode: <?php echo htmlspecialchars($s['exam_mode']); ?>)
      </li>
    <?php endforeach; ?>
  </ul>


</main>
