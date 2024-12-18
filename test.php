SELECT a.userID,a.first_name,a.last_name,SUM(a.total_invoice) total_invoice ,SUM(a.total_amount) total_amount,SUM(a.paid) paid,SUM(a.cash) cash,SUM(a.balance) balance,SUM(a.total_return_amount) total_return_amount
FROM(
SELECT
sma_users.`id` AS userID,
  sma_users.`first_name`,
  sma_users.`last_name`,
  COUNT(sma_payments.sale_id) AS total_invoice,
  SUM(sma_sales.grand_total) AS total_amount,
  SUM(sma_payments.`amount`) AS paid,
  SUM(
    CASE
      WHEN sma_payments.`paid_by` = 'cash'
      THEN sma_payments.`amount`
      ELSE 0
    END
  ) cash,
  SUM(sma_sales.grand_total) - SUM(sma_sales.paid) AS balance,
  0 total_return_amount
FROM
  `sma_users`
  LEFT JOIN `sma_sales`
    ON `sma_users`.`id` = sma_sales.`created_by`
  LEFT JOIN `sma_payments`
    ON `sma_payments`.`sale_id` = sma_sales.`id`
WHERE `sma_payments`.`date` BETWEEN "2023-06-01"
  AND "2023-06-02"
GROUP BY `sma_users`.`id`
UNION ALL
SELECT
sma_users.`id` AS userID,
  sma_users.`first_name`,
  sma_users.`last_name`,
  0 total_invoice,
  0 total_amount,
  0 paid,
  0 cash,
  0 balance,
  SUM(`sma_returns`.grand_total) AS total_return_amount
FROM
  `sma_users`
  LEFT JOIN `sma_returns`
    ON `sma_users`.`id` = sma_returns.`created_by`
WHERE `sma_returns`.`date` BETWEEN "2023-06-01"
  AND "2023-06-02"
GROUP BY `sma_users`.`id`  ) AS a
GROUP BY a.userID,a.first_name,a.last_name
