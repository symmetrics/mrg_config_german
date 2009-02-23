import os
import sys
import string
import logging
import time

from symmetrics_saasrepo_installer import base, shortcuts


config = None # will be filled by main() with the current config dict
package_dir = os.path.dirname(os.path.abspath(__file__))
logger = logging.getLogger('symmetrics_config_german.post_install')


def _read_file_contents(filename, ext='.txt'):
    fd = file(os.path.join(package_dir, filename + ext), 'r')
    content = fd.read()
    fd.close()
    return content

def _write_file_contents(filename, content, ext='.txt'):
    fd = file(os.path.join(package_dir, filename + ext), 'w')
    fd.write(content)
    fd.close()

def main(config_module, info_py):
    '''Is being called by the installer'''
    global config
    config = config_module
    sql_file = os.path.join(package_dir, 'config.sql')
    
    sql = _read_file_contents('config', '.sql')
    
    # TODO substitute should not do $varname but only ${varname}!
    sql = string.Template(sql).substitute({
        'text_pagenotfound': _read_file_contents('page_not_found'),
        'datetime': time.strftime("%Y-%m-%d %H:%M:%S"),
        'text_home': _read_file_contents('home'),
        'text_rueckgabe': _read_file_contents('rueckgabe'),
        'text_ueberuns': _read_file_contents('ueber_uns'),
        'text_zahlung': _read_file_contents('zahlung'),
        'text_agb': _read_file_contents('agb'),
        'http_url': 'http://' + config['magento']['http_url'],
        'https_url': 'https://' + config['magento']['https_url'],
        'template': '', # TODO
        'shopname': config['magento']['shop_name'],
        'meta_description': config['magento']['meta_description'],
        'meta_keywords': config['magento']['meta_keywords'],
        'meta_robots': config['magento']['meta_robots'],
        'welcome': config['magento']['welcome_msg'],
        'copyright': config['magento']['copyright'],
        'company': config['customer']['company_name'],
        'company2': config['customer']['holder_name'],
        'email': config['magento']['contact_addresses']['general'],
        'email_sales': config['magento']['contact_addresses']['sales'],
        'email_support': config['magento']['contact_addresses']['support'],
        'email_custom1': config['magento']['contact_addresses']['custom1'],
        'email_custom2': config['magento']['contact_addresses']['custom2'],
        'emaildomain': config['magento']['email_domain'],
        'street': config['customer']['street'],
        'zip': config['customer']['zip'],
        'city': config['customer']['city'],
        'firstname': config['customer']['firstname'],
        'lastname': config['customer']['lastname'],
        'country': config['customer']['country'],
        'telephone': config['customer']['phone'],
        'fax': config['customer']['fax'],
        'homepage': config['customer']['homepage'],
        'tax_number': config['customer']['tax_number'],
        'sales_tax_id_number': config['customer']['sales_tax_id_number'],
        'commercial_register': config['customer']['commercial_register'],
        'tax_office': config['customer']['tax_office'],
        'hrb': config['customer']['hrb'],
        'bank_account': config['customer']['bank_account'],
        'bank_account_owner': config['customer']['bank_account_owner'],
        'bank_id_code': config['customer']['bank_id_code'],
        'bank_connection': config['customer']['bank_name'],
        'swift': config['customer']['bank_swift'],
        'iban': config['customer']['bank_iban'],
        'invoice_maturity': config['magento']['invoice_maturity'],
        'invoice_note': config['magento']['invoice_note'],
        'invoice_customerprefix': config['magento']['invoice_customer_prefix'],
    })
    
    _write_file_contents(sql_file, sql)
    
    cmd = 'mysql -u${username} -p${password} -h${hostname} ${database} < ${sql_file}'
    cmd = string.Template(cmd).substitute({
        'hostname': config['database_connection']['hostname'],
        'username': config['database_connection']['username'],
        'password': config['database_connection']['password'],
        'database': config['database_connection']['database'],
        'sql_file': sql_file,
    })
    logger.info('executing: %s' % cmd)
    if os.system(cmd):
        raise Exception('could not install base config data for magento.')
