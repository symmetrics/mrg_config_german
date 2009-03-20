import os
import sys
import string
import logging
import time

from symmetrics_saasrepo_installer import base, shortcuts


config = None # will be filled by main() with the current config dict
package_dir = os.path.dirname(os.path.abspath(__file__))
logger = logging.getLogger('symmetrics_config_german.pre_install')


def _read_file_contents(filename, ext='.html'):
    fd = file(os.path.join(package_dir, filename + ext), 'r')
    content = fd.read()
    fd.close()
    return content

def _write_file_contents(filename, content, ext='.html'):
    fd = file(os.path.join(package_dir, filename + ext), 'w')
    fd.write(content)
    fd.close()

def _emailify(dict_):
    return '"%s" <%s>' % (dict_['name'], dict_['email'])

def _replace_in_text(text, dict_):
    for key, val in dict_.iteritems():
        if type(val) is not basestring:
            val = str(val)
        text = text.replace('${%s}' % key, val)
    return text

def main(config_module, info_py):
    '''Is being called by the installer'''
    global config
    config = config_module
    sql_file = os.path.join(package_dir, 'config.sql')
    
    config_php = os.path.join('build', 'app', 'code', 'local', 'Symmetrics', 'Config',
                              'sql', 'symconfig_setup', 'mysql4-install-0.0.1')
    content = _read_file_contents(config_php, '.php')
    
    customer = config['customer']
    magento = config['magento']
    
    content = _replace_in_text(content, {
        'text_pagenotfound': _read_file_contents('page_not_found'),
        'datetime': time.strftime("%Y-%m-%d %H:%M:%S"),
        'text_home': _read_file_contents('home'),
        'text_ueberuns': _read_file_contents('ueber_uns'),
        'text_zahlung': _read_file_contents('zahlung'),
        'text_versand': _read_file_contents('versand'),
        'text_impressum': _read_file_contents('impressum'),
        'text_agb': _read_file_contents('agb'),
        'text_bestellvorgang': _read_file_contents('bestellvorgang'),
        'text_datenschutz': _read_file_contents('datenschutz'),
        'shopname': magento['shop_name'],
        'meta_description': magento['meta_description'],
        'meta_keywords': magento['meta_keywords'],
        'meta_robots': magento['meta_robots'],
        'welcome': magento['welcome_msg'],
        'copyright': magento['copyright'],
        'company': customer['company_name'],
        'company2': customer['holder_name'],
        'email': customer['email'],
        'ident_general_name': magento['contact_addresses']['general']['name'],
        'ident_general_email': magento['contact_addresses']['general']['name'],
        'ident_sales_name': magento['contact_addresses']['sales']['name'],
        'ident_sales_email': magento['contact_addresses']['sales']['email'],
        'ident_support_name': magento['contact_addresses']['support']['name'],
        'ident_support_email': magento['contact_addresses']['support']['email'],
        'ident_custom1_name': magento['contact_addresses']['custom1']['name'],
        'ident_custom1_email': magento['contact_addresses']['custom1']['email'],
        'ident_custom2_name': magento['contact_addresses']['custom2']['name'],
        'ident_custom2_email': magento['contact_addresses']['custom2']['email'],
        'emaildomain': magento['email_domain'],
        'street': customer['street'],
        'zip': customer['zip'],
        'city': customer['city'],
        'firstname': customer['firstname'],
        'lastname': customer['lastname'],
        'country': customer['country'],
        'telephone': customer['phone'],
        'fax': customer['fax'],
        'homepage': customer['homepage'],
        'tax_number': customer['tax_number'],
        'sales_tax_id_number': customer['sales_tax_id_number'],
        'commercial_register': customer['commercial_register'],
        'tax_office': customer['tax_office'],
        'hrb': customer['hrb'],
        'bank_account': customer['bank_account'],
        'bank_account_owner': customer['bank_account_owner'],
        'bank_id_code': customer['bank_id_code'],
        'bank_connection': customer['bank_name'],
        'swift': customer['bank_swift'],
        'iban': customer['bank_iban'],
        'invoice_maturity': magento['invoice_maturity'],
        'invoice_note': magento['invoice_note'],
        'invoice_customerprefix': magento['invoice_customer_prefix'],
    })
    
    _write_file_contents(config_php, content, '.php')
