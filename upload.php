<?php

include './config.php';

// Create a PDO instance
try {
     // Connection to the database
     $bdd = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

// Function to import CSV to database
function importCSV($filePath) {
    global $bdd;

    // Prepare the SQL statement
    $stmt = $bdd->prepare("INSERT INTO `leads`(
        `record_id`, `lead_owner_id`, `lead_owner`, `company`, `first_name`, `last_name`, `title`, `email`, `phone`, `fax`, `mobile`, `website`, 
        `lead_source`, `lead_status`, `industry`, `number_of_employees`, `annual_revenue`, `rating`, `created_by_id`, `created_by`, 
        `modified_by_id`, `modified_by`, `created_time`, `modified_time`, `lead_name`, `street`, `city`, `state`, `zip_code`, 
        `country`, `description`, `skype_id`, `email_opt_out`, `salutation`, `secondary_email`, `last_activity_time`, `twitter`, 
        `layout_id`, `layout`, `tag`, `converted_date_time`, `lead_conversion_time`, `unsubscribed_mode`, `unsubscribed_time`, 
        `converted_account_id`, `converted_account`, `converted_contact_id`, `converted_contact`, `converted_deal_id`, `converted_deal`, 
        `change_log_time`, `is_converted`, `locked`, `last_enriched_time`, `enrich_status`, `team_name`, `players_ready`, 
        `comments_questions`, `captain_interest`, `club_facility`, `league_division_interests`, `age_interests`, `level_of_play`, 
        `partner_plus_one`, `womens_doubles_partner_first_name`, `womens_doubles_partner_last_name`, 
        `mens_doubles_partner_first_name`, `mens_doubles_partner_last_name`, `mixed_doubles_partner_first_name`, 
        `mixed_doubles_partner_last_name`
    ) VALUES (
        :record_id, :lead_owner_id, :lead_owner, :company, :first_name, :last_name, :title, :email, :phone, :fax, :mobile, :website, 
        :lead_source, :lead_status, :industry, :number_of_employees, :annual_revenue, :rating, :created_by_id, :created_by, 
        :modified_by_id, :modified_by, :created_time, :modified_time, :lead_name, :street, :city, :state, :zip_code, 
        :country, :description, :skype_id, :email_opt_out, :salutation, :secondary_email, :last_activity_time, :twitter, 
        :layout_id, :layout, :tag, :converted_date_time, :lead_conversion_time, :unsubscribed_mode, :unsubscribed_time, 
        :converted_account_id, :converted_account, :converted_contact_id, :converted_contact, :converted_deal_id, :converted_deal, 
        :change_log_time, :is_converted, :locked, :last_enriched_time, :enrich_status, :team_name, :players_ready, 
        :comments_questions, :captain_interest, :club_facility, :league_division_interests, :age_interests, :level_of_play, 
        :partner_plus_one, :womens_doubles_partner_first_name, :womens_doubles_partner_last_name, 
        :mens_doubles_partner_first_name, :mens_doubles_partner_last_name, :mixed_doubles_partner_first_name, 
        :mixed_doubles_partner_last_name
    )");

    // Open the CSV file
    if (($handle = fopen($filePath, 'r')) !== FALSE) {
        // Read and discard the header line
        $header = fgetcsv($handle, 1000, ';');

        // Read the CSV file line by line
        while (($data = fgetcsv($handle, 1000, ';')) !== FALSE) {
            // Ensure the number of columns in your CSV matches the number of placeholders
            // if (count($data) != 71) {
            //     // Log the error
            //     error_log("Row does not match expected number of columns. Row data: " . implode(';', $data));
            //     continue; // Skip this row
            // }

                   // Bind values to placeholders, using empty string if index is undefined
                   $stmt->bindValue(':record_id', isset($data[0]) ? $data[0] : '');
                   $stmt->bindValue(':lead_owner_id', isset($data[1]) ? $data[1] : '');
                   $stmt->bindValue(':lead_owner', isset($data[2]) ? $data[2] : '');
                   $stmt->bindValue(':company', isset($data[3]) ? $data[3] : '');
                   $stmt->bindValue(':first_name', isset($data[4]) ? $data[4] : '');
                   $stmt->bindValue(':last_name', isset($data[5]) ? $data[5] : '');
                   $stmt->bindValue(':title', isset($data[6]) ? $data[6] : '');
                   $stmt->bindValue(':email', isset($data[7]) ? $data[7] : '');
                   $stmt->bindValue(':phone', isset($data[8]) ? $data[8] : '');
                   $stmt->bindValue(':fax', isset($data[9]) ? $data[9] : '');
                   $stmt->bindValue(':mobile', isset($data[10]) ? $data[10] : '');
                   $stmt->bindValue(':website', isset($data[11]) ? $data[11] : '');
                   $stmt->bindValue(':lead_source', isset($data[12]) ? $data[12] : '');
                   $stmt->bindValue(':lead_status', isset($data[13]) ? $data[13] : '');
                   $stmt->bindValue(':industry', isset($data[14]) ? $data[14] : '');
                   $stmt->bindValue(':number_of_employees', isset($data[15]) ? $data[15] : '');
                   $stmt->bindValue(':annual_revenue', isset($data[16]) ? $data[16] : '');
                   $stmt->bindValue(':rating', isset($data[17]) ? $data[17] : '');
                   $stmt->bindValue(':created_by_id', isset($data[18]) ? $data[18] : '');
                   $stmt->bindValue(':created_by', isset($data[19]) ? $data[19] : '');
                   $stmt->bindValue(':modified_by_id', isset($data[20]) ? $data[20] : '');
                   $stmt->bindValue(':modified_by', isset($data[21]) ? $data[21] : '');
                   $stmt->bindValue(':created_time', isset($data[22]) ? $data[22] : '');
                   $stmt->bindValue(':modified_time', isset($data[23]) ? $data[23] : '');
                   $stmt->bindValue(':lead_name', isset($data[24]) ? $data[24] : '');
                   $stmt->bindValue(':street', isset($data[25]) ? $data[25] : '');
                   $stmt->bindValue(':city', isset($data[26]) ? $data[26] : '');
                   $stmt->bindValue(':state', isset($data[27]) ? $data[27] : '');
                   $stmt->bindValue(':zip_code', isset($data[28]) ? $data[28] : '');
                   $stmt->bindValue(':country', isset($data[29]) ? $data[29] : '');
                   $stmt->bindValue(':description', isset($data[30]) ? $data[30] : '');
                   $stmt->bindValue(':skype_id', isset($data[31]) ? $data[31] : '');
                   $stmt->bindValue(':email_opt_out', isset($data[32]) ? $data[32] : '');
                   $stmt->bindValue(':salutation', isset($data[33]) ? $data[33] : '');
                   $stmt->bindValue(':secondary_email', isset($data[34]) ? $data[34] : '');
                   $stmt->bindValue(':last_activity_time', isset($data[35]) ? $data[35] : '');
                   $stmt->bindValue(':twitter', isset($data[36]) ? $data[36] : '');
                   $stmt->bindValue(':layout_id', isset($data[37]) ? $data[37] : '');
                   $stmt->bindValue(':layout', isset($data[38]) ? $data[38] : '');
                   $stmt->bindValue(':tag', isset($data[39]) ? $data[39] : '');
                   $stmt->bindValue(':converted_date_time', isset($data[40]) ? $data[40] : '');
                   $stmt->bindValue(':lead_conversion_time', isset($data[41]) ? $data[41] : '');
                   $stmt->bindValue(':unsubscribed_mode', isset($data[42]) ? $data[42] : '');
                   $stmt->bindValue(':unsubscribed_time', isset($data[43]) ? $data[43] : '');
                   $stmt->bindValue(':converted_account_id', isset($data[44]) ? $data[44] : '');
                   $stmt->bindValue(':converted_account', isset($data[45]) ? $data[45] : '');
                   $stmt->bindValue(':converted_contact_id', isset($data[46]) ? $data[46] : '');
                   $stmt->bindValue(':converted_contact', isset($data[47]) ? $data[47] : '');
                   $stmt->bindValue(':converted_deal_id', isset($data[48]) ? $data[48] : '');
                   $stmt->bindValue(':converted_deal', isset($data[49]) ? $data[49] : '');
                   $stmt->bindValue(':change_log_time', isset($data[50]) ? $data[50] : '');
                   $stmt->bindValue(':is_converted', isset($data[51]) ? $data[51] : '');
                   $stmt->bindValue(':locked', isset($data[52]) ? $data[52] : '');
                   $stmt->bindValue(':last_enriched_time', isset($data[53]) ? $data[53] : '');
                   $stmt->bindValue(':enrich_status', isset($data[54]) ? $data[54] : '');
                   $stmt->bindValue(':team_name', isset($data[55]) ? $data[55] : '');
                   $stmt->bindValue(':players_ready', isset($data[56]) ? $data[56] : '');
                   $stmt->bindValue(':comments_questions', isset($data[57]) ? $data[57] : '');
                   $stmt->bindValue(':captain_interest', isset($data[58]) ? $data[58] : '');
                   $stmt->bindValue(':club_facility', isset($data[59]) ? $data[59] : '');
                   $stmt->bindValue(':league_division_interests', isset($data[60]) ? $data[60] : '');
                   $stmt->bindValue(':age_interests', isset($data[61]) ? $data[61] : '');
                   $stmt->bindValue(':level_of_play', isset($data[62]) ? $data[62] : '');
                   $stmt->bindValue(':partner_plus_one', isset($data[63]) ? $data[63] : '');
                   $stmt->bindValue(':womens_doubles_partner_first_name', isset($data[64]) ? $data[64] : '');
                   $stmt->bindValue(':womens_doubles_partner_last_name', isset($data[65]) ? $data[65] : '');
                   $stmt->bindValue(':mens_doubles_partner_first_name', isset($data[66]) ? $data[66] : '');
                   $stmt->bindValue(':mens_doubles_partner_last_name', isset($data[67]) ? $data[67] : '');
                   $stmt->bindValue(':mixed_doubles_partner_first_name', isset($data[68]) ? $data[68] : '');
                   $stmt->bindValue(':mixed_doubles_partner_last_name', isset($data[69]) ? $data[69] : '');
       

            // Execute the statement
            try {
                $stmt->execute();
            } catch (PDOException $e) {
                // Log the error
                error_log("Failed to execute query: " . $e->getMessage());
            }
        }

        fclose($handle);
    } else {
        echo "Error opening the file.";
    }
}

// Check if a file is uploaded
if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['file']['tmp_name'];
    importCSV($fileTmpPath);
    echo "CSV file has been imported successfully.";
} else {
    echo "Error uploading the file.";
}
?>
